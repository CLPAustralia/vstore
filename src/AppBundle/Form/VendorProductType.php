<?php

namespace AppBundle\Form;

use AppBundle\Entity\VendorProduct;
use AppBundle\Form\CompanyType;
use AppBundle\Form\ProductType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class VendorProductType extends AbstractType
{

  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('name', TextType::class)
            ->add('product', ProductType::class)
            ->add('vendor', CompanyType::class);
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array('data_class' => VendorProduct::class));
  }

}

