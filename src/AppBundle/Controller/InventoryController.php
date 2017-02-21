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

    $form = $this->createForm(InventoryType::class, $inventory);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid())
    {

      $inventory = $form->getData();
      $em = $this->getDoctrine()->getManager();
      $em->persist($inventory);
      $em->flush();

      return $this->redirectToRoute('inventory_show', array('id' => $inventory->getId()));

    }

    return $this->render('inventory/inventory_new.html.twig', array('form' => $form->createView()));

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

    $firstName = $request->request->get("firstName");
    $lastName = $request->request->get("lastName");

    $repo = $this->getRepo();
    $query = $repo->createQueryBuilder('p')
      ->where('p.firstName like :firstName')
      ->andWhere('p.lastName like :lastName')
      ->setParameter('firstName', $firstName.'%')
      ->setParameter('lastName', $lastName.'%')
      ->getQuery();
    $result = $query->getResult();

    return $this->render('inventory/inventory_list_widget.html.twig', array('inventoryList' => $result)); 

  }

  private function getRepo()
  {
    return $this->getDoctrine()->getRepository('AppBundle:Inventory');
  }

}
