<?php

namespace AppBundle\Controller;

use AppBundle\Form\InventoryType;
use AppBundle\Entity\Inventory;
use AppBundle\Entity\Address;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/inventory")
 */
class InventoryController extends Controller
{

  /**
   * @Route("/new", name="inventory_new")
   */
  public function newAction(Request $request)
  {

    $inventory = new Inventory();

    $productId = $request->request->get('productId');
    $product = $this->getDoctrine()->getRepository('AppBundle:Product')->findOneById($productId);

    $companyId = $request->request->get('companyId');
    $company = $this->getDoctrine()->getRepository('AppBundle:Company')->findOneById($companyId);

    $vendorProductName = $request->request->get('vendor_product_name');
    $quantity = $request->request->get('quantity');

    // TODO: validation
    if ($productId && $companyId) 
    {

      $inventory->setVendor($company);
      $inventory->setProduct($product);
      $inventory->setVendorProductName($vendorProductName);
      $inventory->setQuantity($quantity);

      $em = $this->getDoctrine()->getManager();
      $em->persist($inventory);
      $em->flush();

      return $this->redirectToRoute('inventory_show', array('id' => $inventory->getId()));
    
    }

    return $this->render('inventory/inventory_new.html.twig');

  }

  /**
   * @Route("/show/{id}", name="inventory_show")
   */
  public function showAction(Request $request, $id)
  {
    
    $repo = $this->getRepo(); 
    $inventory = $repo->findOneById($id);
    if (!$inventory) 
    {
      throw $this->createNotFoundException("Unable to find inventory by id: $id");
    }
    return $this->render('inventory/inventory_show.html.twig', array('inventory' => $inventory));

  }

  /**
   * @Route("/search", name="inventory_search")
   */
  public function searchAction(Request $request)
  {
    return $this->render('inventory/inventory_search.html.twig'); 
  }

  /**
   * @Route("/list", name="inventory_list")
   */
  public function listInventoryAction(Request $request){

    $vendorProductName = $request->request->get("vendorProductName");
    $ignoreHeader = $request->request->get('ignoreHeader');
    $ignoreFooter = $request->request->get('ignoreFooter');

    $repo = $this->getRepo();
    $query = $repo->createQueryBuilder('p')
      ->where('p.vendorProductName like :vendorProductName')
      ->setParameter('vendorProductName', $vendorProductName.'%')
      ->getQuery();
    $result = $query->getResult();

    return $this->render('inventory/inventory_list.html.twig', array('inventoryList' => $result, 'ignoreHeader' => $ignoreHeader, 'ignoreFooter' => $ignoreFooter)); 

  }

  private function getRepo()
  {
    return $this->getDoctrine()->getRepository('AppBundle:Inventory');
  }

}
