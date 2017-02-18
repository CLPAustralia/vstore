<?php

namespace AppBundle\Controller;

use AppBundle\Form\PersonType;
use AppBundle\Entity\Person;
use AppBundle\Entity\Address;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PersonController extends Controller
{

  /**
   * @Route("/newPerson", name="new_person")
   */
  public function newPersonAction(Request $request)
  {

    $person = new Person();

    // TEST
    $addr = new Address();
    $addr->setType('Home');
    $person->addAddress($addr);

    $addr = new Address();
    $addr->setType('Work');
    $person->addAddress($addr);

    $form = $this->createForm(PersonType::class, $person);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid())
    {

      $person = $form->getData();
      $em = $this->getDoctrine()->getManager();
      $em->persist($person);
      $em->flush();

      return $this->render('person_show.html.twig', array('person' => $person));

    }

    return $this->render('person_new.html.twig', array('form' => $form->createView()));

  }

}
