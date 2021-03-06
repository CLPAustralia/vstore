<?php

namespace AppBundle\Form;

use AppBundle\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AddressType extends AbstractType
{

  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('type', TextType::class, array('label' => 'address.type'))
            ->add('addressLine1', TextType::class, array('label' => 'address.line1'))
            ->add('addressLine2', TextType::class, array('label' => 'address.line2'));
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array('data_class' => Address::class));
  }

}

