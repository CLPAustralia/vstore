<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Inventory;

class LoadInventoryData extends AbstractFixture implements OrderedFixtureInterface 
{

  public function load(ObjectManager $manager)
  {

    $inventory = new Inventory();
    $inventory->setVendorProductName('Vendor Product Name 01');
    $inventory->setQuantity(1234);
    $inventory->setVendor($this->getReference('company01'));
    $inventory->setProduct($this->getReference('product01'));
    $manager->persist($inventory);

    $inventory = new Inventory();
    $inventory->setVendorProductName('Vendor Product Name 02');
    $inventory->setQuantity(4321);
    $inventory->setVendor($this->getReference('company02'));
    $inventory->setProduct($this->getReference('product02'));
    $manager->persist($inventory);

    $manager->flush();

  }

  public function getOrder()
  {
    return 3;
  }
}
