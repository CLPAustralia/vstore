<?php

namespace AppBundle\Controller;

use AppBundle\Form\ProductType;
use AppBundle\Entity\Product;
use AppBundle\Entity\Address;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/product")
 */
class ProductController extends Controller
{

  /**
   * @Route("/new", name="product_new")
   */
  public function newAction(Request $request)
  {

    $product = new Product();

    $form = $this->createForm(ProductType::class, $product);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid())
    {

      $product = $form->getData();
      $em = $this->getDoctrine()->getManager();
      $em->persist($product);
      $em->flush();

      return $this->redirectToRoute('product_show', array('id' => $product->getId()));

    }

    return $this->render('product/product_new.html.twig', array('form' => $form->createView()));

  }

  private function getProductById($id)
  {
    $repo = $this->getRepo(); 
    $product = $repo->findOneById($id);
    if (!$product) 
    {   
      throw $this->createNotFoundException("Unable to find product by id: $id");
    }   
    return $product;
  }

  /**
   * @Route("/show/{id}", name="product_show")
   */
  public function showAction(Request $request, $id)
  {
    return $this->render('product/product_show.html.twig', array('product' => $this->getProductById($id)));
  }

  /** 
   * @Route("/show/widget/{id}", name="product_show_widget")
   */  
  public function showWidgetAction(Request $request, $id)
  { 
    return $this->render('product/product_show_widget.html.twig', array('product' => $this->getProductById($id)));
  }


  /**
   * @Route("/search", name="product_search")
   */
  public function searchAction(Request $request)
  {
    return $this->render('product/product_search.html.twig'); 
  }

  /**
   * @Route("/list", name="product_list")
   */
  public function listProductAction(Request $request){

    $name = $request->request->get("name");
    $selectable = $request->request->get("selectable");

    $repo = $this->getRepo();
    $query = $repo->createQueryBuilder('c')
      ->where('c.name like :name')
      ->setParameter('name', $name.'%')
      ->getQuery();
    $result = $query->getResult();

    return $this->render('product/product_list_widget.html.twig', array('productList' => $result, 'selectable' => $selectable)); 

  }

  private function getRepo()
  {
    return $this->getDoctrine()->getRepository('AppBundle:Product');
  }

}
