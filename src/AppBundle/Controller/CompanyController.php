<?php

namespace AppBundle\Controller;

use AppBundle\Form\CompanyType;
use AppBundle\Entity\Company;
use AppBundle\Entity\Address;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/company")
 */
class CompanyController extends Controller
{

  /**
   * @Route("/new", name="company_new")
   */
  public function newAction(Request $request)
  {

    $company = new Company();

    $form = $this->createForm(CompanyType::class, $company);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid())
    {

      $company = $form->getData();
      $em = $this->getDoctrine()->getManager();
      $em->persist($company);
      $em->flush();

      return $this->redirectToRoute('company_show', array('id' => $company->getId()));

    }

    return $this->render('company/company_new.html.twig', array('form' => $form->createView()));

  }

  /**
   * @Route("/show/{id}", name="company_show")
   */
  public function showAction(Request $request, $id)
  {
    
    $repo = $this->getRepo(); 
    $company = $repo->findOneById($id);
    if (!$company) 
    {
      throw $this->createNotFoundException("Unable to find company by id: $id");
    }
    return $this->render('company/company_show.html.twig', array('company' => $company));

  }

  /**
   * @Route("/search", name="company_search")
   */
  public function searchAction(Request $request)
  {
    return $this->render('company/company_search.html.twig'); 
  }

  /**
   * @Route("/list", name="company_list")
   */
  public function listCompanyAction(Request $request){

    $name = $request->request->get("name");

    $repo = $this->getRepo();
    $query = $repo->createQueryBuilder('c')
      ->where('c.name like :name')
      ->setParameter('name', $name.'%')
      ->getQuery();
    $result = $query->getResult();

    return $this->render('company/company_list.html.twig', array('companyList' => $result)); 

  }

  private function getRepo()
  {
    return $this->getDoctrine()->getRepository('AppBundle:Company');
  }

}
