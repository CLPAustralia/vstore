<?php

namespace AppBundle\Form;

use AppBundle\Entity\Person;
use AppBundle\Form\AddressType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonType extends AbstractType
{

  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('title', TextType::class)
            ->add('firstName', TextType::class)
            ->add('lastName', TextType::class)
            ->add('save', SubmitType::class)
            ->add('addresses', 
                  CollectionType::class, 
                  array('entry_type' => AddressType::class, 
                        'allow_add' => true));
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array('data_class' => Person::class));
  }

}
