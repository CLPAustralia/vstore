<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Company;

class LoadCompanyData extends AbstractFixture implements OrderedFixtureInterface 
{

  public function load(ObjectManager $manager)
  {

    $company = new Company();
    $company->setName('Company 01');
    $company->addAddress($this->getReference('company1-address1'));
    $company->addAddress($this->getReference('company1-address2'));
    $manager->persist($company);
    $this->addReference('company01', $company);

    $company = new Company();
    $company->setName('Company 02');
    $company->addAddress($this->getReference('company2-address1'));
    $company->addAddress($this->getReference('company2-address2'));
    $manager->persist($company);
    $this->addReference('company02', $company);

    $manager->flush();

  }

  public function getOrder()
  {
    return 2;
  }
}
