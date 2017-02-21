<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Inventory
 *
 * @ORM\Table(name="inventory")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InventoryRepository")
 */
class Inventory
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * @ORM\OneToOne(targetEntity="VendorProduct")
     * @ORM\JoinColumn(name="vendor_product_id", referencedColumnName="id")
     */
    private $vendorProduct;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return Inventory
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set vendorProduct
     *
     * @param \AppBundle\Entity\VendorProduct $vendorProduct
     *
     * @return Inventory
     */
    public function setVendorProduct(\AppBundle\Entity\VendorProduct $vendorProduct = null)
    {
        $this->vendorProduct = $vendorProduct;

        return $this;
    }

    /**
     * Get vendorProduct
     *
     * @return \AppBundle\Entity\VendorProduct
     */
    public function getVendorProduct()
    {
        return $this->vendorProduct;
    }

    /**
     * Set vendor
     *
     * @param \AppBundle\Entity\Company $vendor
     *
     * @return Inventory
     */
    public function setVendor(\AppBundle\Entity\Company $vendor = null)
    {
        $this->vendor = $vendor;

        return $this;
    }

    /**
     * Get vendor
     *
     * @return \AppBundle\Entity\Company
     */
    public function getVendor()
    {
        return $this->vendor;
    }
}
