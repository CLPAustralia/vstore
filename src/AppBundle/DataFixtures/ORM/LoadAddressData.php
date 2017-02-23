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
    $manager->persist($personAddr1);
    $this->addReference('person1-address1', $personAddr1);

    $personAddr2 = new Address();
    $personAddr2->setType('Work');
    $personAddr2->setAddressLine1('Person1 Address2 Line1');
    $personAddr2->setAddressLine1('Person1 Address2 Line2');
    $manager->persist($personAddr2);
    $this->addReference('person1-address2', $personAddr2);

    $personAddr3 = new Address();
    $personAddr3->setType('Home');
    $personAddr3->setAddressLine1('Person2 Address1 Line1');
    $personAddr3->setAddressLine1('Person2 Address1 Line2');
    $manager->persist($personAddr3);
    $this->addReference('person2-address1', $personAddr3);

    $personAddr4 = new Address();
    $personAddr4->setType('Work');
    $personAddr4->setAddressLine1('Person2 Address2 Line1');
    $personAddr4->setAddressLine1('Person2 Address2 Line2');
    $manager->persist($personAddr4);
    $this->addReference('person2-address2', $personAddr4);

    $companyAddr1 = new Address();
    $companyAddr1->setType('Work');
    $companyAddr1->setAddressLine1('Company1 Address1 Line1');
    $companyAddr1->setAddressLine1('Company1 Address1 Line2');
    $manager->persist($companyAddr1);
    $this->addReference('company1-address1', $companyAddr1);

    $companyAddr2 = new Address();
    $companyAddr2->setType('Delivery');
    $companyAddr2->setAddressLine1('Company1 Address2 Line1');
    $companyAddr2->setAddressLine1('Company1 Address2 Line2');
    $manager->persist($companyAddr2);
    $this->addReference('company1-address2', $companyAddr2);

    $companyAddr3 = new Address();
    $companyAddr3->setType('Work');
    $companyAddr3->setAddressLine1('Company2 Address1 Line1');
    $companyAddr3->setAddressLine1('Company2 Address1 Line2');
    $manager->persist($companyAddr3);
    $this->addReference('company2-address1', $companyAddr3);

    $companyAddr4 = new Address();
    $companyAddr4->setType('Delivery');
    $companyAddr4->setAddressLine1('Company4 Address2 Line1');
    $companyAddr4->setAddressLine1('Company4 Address2 Line2');
    $manager->persist($companyAddr4);
    $this->addReference('company2-address2', $companyAddr4);

    $manager->flush();

  }

  public function getOrder()
  {
    return 1;
  }

}
