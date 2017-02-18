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
    $builder->add('type', TextType::class)
            ->add('addressLine1', TextType::class)
            ->add('addressLine2', TextType::class);
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array('data_class' => Address::class));
  }

}

