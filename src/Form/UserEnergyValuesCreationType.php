<?php

namespace App\Form;

use App\Entity\UserEnergyValuesCreation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserEnergyValuesCreationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('strength_name')
            ->add('actually_notation')
            ->add('expected_notation')
            ->add('action_one')
            ->add('action_two')
            ->add('action_three')
            ->add('action_four')
            ->add('action_five')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserEnergyValuesCreation::class,
        ]);
    }
}
