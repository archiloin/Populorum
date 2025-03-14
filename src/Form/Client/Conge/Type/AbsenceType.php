<?php

namespace App\Form\Client\Conge\Type;

use App\Entity\Client\Conge\Absence;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class AbsenceType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('note', TextAreaType::class, array(
                'required' => false,
            ))
            ->add('debut', DateTimeType::class, array(
                'date_widget' => 'single_text',
            ))
            ->add('fin', DateTimeType::class, array(
                'date_widget' => 'single_text',
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Absence::class,
        ]);
    }
}
