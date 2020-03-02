<?php

namespace App\Form;

use App\Entity\UserAccountCreation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserAccountCreationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('surname')
            ->add('phone')
            ->add('email')
            ->add('function')
            ->add('name_society')
            ->add('address_society')
            ->add('phone_society')
            ->add('coach_name')
            ->add('coaching_beginning')
            ->add('password')
            ->add('confirm_password')
            ->add('accept_terms')
           // ->add('yes')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserAccountCreation::class,
        ]);
    }
}
