<?php

namespace AppBundle\Form;

use AppBundle\Entity\Product;
use AppBundle\Form\AddressType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{

  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('name', TextType::class, array('label' => 'product.name'))
            ->add('description', TextType::class, array('label' => 'product.description'))
            ->add('upc', IntegerType::class, array('label' => 'product.upc'))
            ->add('save', SubmitType::class, array('label' => 'button.save'));
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array('data_class' => Product::class));
  }

}
