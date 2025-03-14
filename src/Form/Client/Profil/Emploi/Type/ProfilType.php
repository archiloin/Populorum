<?php
namespace App\Form\Client\Profil\Emploi\Type;

use App\Entity\Client\Profil\Emploi\Profil;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ProfilType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('job')
            ->add('description')
            ->add('statut')
            ->add('structure')
            ->add('startedAt', DateType::class, array(
                  'widget' => 'single_text',
                  'required' => false,
            ))
            ->add('start', DateType::class, array(
                  'widget' => 'single_text',
                  'required' => false,
            ))
            ->add('end', DateType::class, array(
                  'widget' => 'single_text',
                  'required' => false,
            ))
            ->add('info')
        ;


    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Profil::class
        ));
    }

}
