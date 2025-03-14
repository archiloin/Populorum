<?php
namespace App\Form\Client\Profil\InformationsEntreprise\Type;

use App\Entity\Client\Profil\InformationsEntreprise\Profil;
use App\Form\Client\Profil\InformationsEntreprise\Type\LogoType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfilType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomEntreprise')
            ->add('logo', LogoType::class)
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
