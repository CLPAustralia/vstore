<?php

namespace AppBundle\Form;

use AppBundle\Entity\Inventory;
use AppBundle\Form\VendorProductType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InventoryType extends AbstractType
{

  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('vendorProduct', VendorProductType::class, array('label' => 'inventory.vendor.product'))
            ->add('quantity', IntegerType::class, array('label' => 'inventory.quantity'));
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array('data_class' => Inventory::class));
  }

}
