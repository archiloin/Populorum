<?php
namespace App\Form\Client\Profil\InformationsPersonnelles\Type;

use App\Entity\Client\Profil\InformationsPersonnelles\Profil;
use App\Form\Client\Profil\InformationsPersonnelles\Type\IdentityType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ProfilType extends AbstractType
{

    const MARIEE = 'Marié';
    const PACSE = 'Pacsé';
    const DIVORCE = 'Divorcé';
    const SEPARE = 'Séparé';
    const CELIBATAIRE = 'Célibataire';
    const VEUF = 'Veuf';

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('civilite', ChoiceType::class, array(
                'choices'  => array(
                    'Mr' => 'Mr',
                    'Mme' => 'Mme'
                    ),
                'multiple' => false, 'expanded' => true, 'required' => false, 'placeholder' => false
                ))
            ->add('identifiant')
            ->add('firstname', TextType::class, [
                'required'     => true,
            ])
            ->add('middlename')
            ->add('lastname', TextType::class, [
                'required'     => true,
            ])
            ->add('nickname')
            ->add('identity', IdentityType::class)
            ->add('familysituation', ChoiceType::class, [
                'choices'  => [
                    'Non choisi' => null,
                    'Marié' => self::MARIEE,
                    'Pacsé' => self::PACSE,
                    'Divorcé' => self::DIVORCE,
                    'Séparé' => self::SEPARE,
                    'Célibataire' => self::CELIBATAIRE,
                    'Veuf' => self::VEUF,
                    ],
                'expanded'  => false,
                'multiple'  => false,
                'required' => false,
                'placeholder' => 'Autre'
            ])
            ->add('dob', DateType::class, array(
                  'widget' => 'single_text',
                  'required' => false,
            ))
            ->add('birthplace')
            ->add('ssn')
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
