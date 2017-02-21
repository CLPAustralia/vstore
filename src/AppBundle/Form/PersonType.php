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
    $builder->add('title', TextType::class, array('label' => 'person.title'))
            ->add('firstName', TextType::class, array('label' => 'person.first.name'))
            ->add('lastName', TextType::class, array('label' => 'person.last.name'))
            ->add('save', SubmitType::class, array('label' => 'button.save'))
            ->add('addresses', 
                  CollectionType::class, 
                  array('entry_type' => AddressType::class, 
                        'allow_add' => true,
                        'label' => 'addresses'));
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array('data_class' => Person::class));
  }

}
