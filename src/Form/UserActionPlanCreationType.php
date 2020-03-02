<?php

namespace App\Form;

use App\Entity\UserActionPlanCreation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserActionPlanCreationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('num')
            ->add('title_action')
            ->add('description')
            ->add('positive_objective')
            ->add('beginning_date')
            ->add('end_date')
            ->add('efficience_action')
            ->add('expected_result')
            ->add('specific_action')
            ->add('mesurable_action')
            ->add('motivating_action')
            ->add('ecological_action')
            ->add('positive_action')
            ->add('realizable_action')
            ->add('internal_resources')
            ->add('external_resources')
            ->add('obstacles')
            ->add('deflect_obstacles')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserActionPlanCreation::class,
        ]);
    }
}
