<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Person;

class LoadPersonData extends AbstractFixture implements OrderedFixtureInterface
{

  public function load(ObjectManager $manager)
  {

    $person = new Person();
    $person->setTitle('Mr');
    $person->setFirstName('First Name 01');
    $person->setLastName('Last Name 01');
    $person->addAddress($this->getReference('person1-address1'));
    $person->addAddress($this->getReference('person1-address2'));

    $manager->persist($person);
    $manager->flush();

  }

  public function getOrder()
  {
    return 2;
  }
}
