<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Address;

class LoadAddressData extends AbstractFixture implements OrderedFixtureInterface
{

  public function load(ObjectManager $manager)
  {

    $personAddr1 = new Address();
    $personAddr1->setType('Home');
    $personAddr1->setAddressLine1('Person1 Address1 Line1');
    $personAddr1->setAddressLine1('Person1 Address1 Line2');

    $personAddr2 = new Address();
    $personAddr2->setType('Work');
    $personAddr2->setAddressLine1('Person1 Address2 Line1');
    $personAddr2->setAddressLine1('Person1 Address2 Line2');

    $companyAddr1 = new Address();
    $companyAddr1->setType('Work');
    $companyAddr1->setAddressLine1('Company1 Address1 Line1');
    $companyAddr1->setAddressLine1('Company1 Address1 Line2');

    $companyAddr2 = new Address();
    $companyAddr2->setType('Delivery');
    $companyAddr2->setAddressLine1('Company2 Address2 Line1');
    $companyAddr2->setAddressLine1('Company2 Address2 Line2');

    $manager->persist($personAddr1);
    $manager->persist($personAddr2);
    $manager->persist($companyAddr1);
    $manager->persist($companyAddr2);
    $manager->flush();

    $this->addReference('person1-address1', $personAddr1);
    $this->addReference('person1-address2', $personAddr2);
    $this->addReference('company1-address1', $companyAddr1);
    $this->addReference('company1-address2', $companyAddr2);

  }

  public function getOrder()
  {
    return 1;
  }

}
