<?php

namespace App\Form;

use App\Entity\UserObjectiveCreation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserObjectiveCreationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('num_objective')
            ->add('objective_title')
            ->add('description_objective')
            ->add('beginning_date')
            ->add('end_date')
            ->add('strength_name')
            ->add('title_action_objective')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserObjectiveCreation::class,
        ]);
    }
}
