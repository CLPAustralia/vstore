<?php

namespace AppBundle\Controller;

use AppBundle\Form\PersonType;
use AppBundle\Entity\Person;
use AppBundle\Entity\Address;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/person")
 */
class PersonController extends Controller
{

  /**
   * @Route("/newPerson", name="new_person")
   */
  public function newPersonAction(Request $request)
  {

    $person = new Person();

    $form = $this->createForm(PersonType::class, $person);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid())
    {

      $person = $form->getData();
      $em = $this->getDoctrine()->getManager();
      $em->persist($person);
      $em->flush();

      return $this->render('person/person_show.html.twig', array('person' => $person));

    }

    return $this->render('person/person_new.html.twig', array('form' => $form->createView()));

  }

  /**
   * @Route("/showPerson/{id}", name="show_person")
   */
  public function showPersonAction(Request $request, $id)
  {
    
    $repo = $this->getRepo(); 
    $person = $repo->findOneById($id);
    if (!$person) 
    {
      throw $this->createNotFoundException("Unable to find person by id: $id");
    }
    return $this->render('person/person_show.html.twig', array('person' => $person));

  }

  /**
   * @Route("/searchPerson", name="search_person")
   */
  public function searchPersonAction(Request $request)
  {
    return $this->render('person/person_search.html.twig'); 
  }

  /**
   * @Route("/listPerson", name="list_person")
   */
  public function listPersonAction(Request $request){

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

    //TODO: search
    $person = new Person();
    $person->setTitle('Mr')->setFirstName('Test Person 1 Firstname')->setLastName('Test Person 1 Last Name');
    $personList[] = $person;
    $person = new Person();
    $person->setTitle('Miss')->setFirstName('Test Person 2 Firstname')->setLastName('Test Person 2 Last Name');
    $personList[] = $person;
    
    return $this->render('person/person_list.html.twig', array('personList' => $result)); 

  }

  private function getRepo()
  {
    return $this->getDoctrine()->getRepository('AppBundle:Person');
  }

}
