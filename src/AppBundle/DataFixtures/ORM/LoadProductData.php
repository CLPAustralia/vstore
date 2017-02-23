<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Product;

class LoadProductData extends AbstractFixture implements OrderedFixtureInterface 
{

  public function load(ObjectManager $manager)
  {

    $product = new Product();
    $product->setName('Product 01');
    $product->setDescription('Description 01');
    $product->setUpc(12345678);
    $manager->persist($product);
    $this->addReference('product01', $product);

    $product = new Product();
    $product->setName('Product 02');
    $product->setDescription('Description 02');
    $product->setUpc(87654321);
    $manager->persist($product);
    $this->addReference('product02', $product);

    $manager->flush();

  }

  public function getOrder()
  {
    return 2;
  }
}
