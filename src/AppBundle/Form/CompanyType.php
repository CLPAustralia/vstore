<?php

namespace AppBundle\Form;

use AppBundle\Entity\Company;
use AppBundle\Form\AddressType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompanyType extends AbstractType
{

  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('name', TextType::class, array('label' => 'company.name'))
            ->add('save', SubmitType::class, array('label' => 'button.save'))
            ->add('addresses', 
                  CollectionType::class, 
                  array('entry_type' => AddressType::class, 
                        'allow_add' => true,
                        'label' => 'addresses'));
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array('data_class' => Company::class));
  }

}
