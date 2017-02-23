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
     * @ORM\OneToOne(targetEntity="Company")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     */
    private $vendor;

    /**
     * @ORM\OneToOne(targetEntity="Product")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $product;

    /**
     * @ORM\Column(name="vendor_product_name", type="text")
     */
    private $vendorProductName;

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

    /**
     * Set vendorProductName
     *
     * @param string $vendorProductName
     *
     * @return Inventory
     */
    public function setVendorProductName($vendorProductName)
    {
        $this->vendorProductName = $vendorProductName;

        return $this;
    }

    /**
     * Get vendorProductName
     *
     * @return string
     */
    public function getVendorProductName()
    {
        return $this->vendorProductName;
    }

    /**
     * Set product
     *
     * @param \AppBundle\Entity\Product $product
     *
     * @return Inventory
     */
    public function setProduct(\AppBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \AppBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }
}
