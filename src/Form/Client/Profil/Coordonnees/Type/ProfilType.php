<?php
namespace App\Form\Client\Profil\Coordonnees\Type;

use App\Entity\Client\Profil\Coordonnees\Profil;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class ProfilType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('address')
            ->add('addresscontinued')
            ->add('city')
            ->add('postalcode', TextType::class, [
                'required'     => false,
            ])
            ->add('country', CountryType::class, array(
                'preferred_choices' => array('FR'),
                'choice_translation_locale' => null,
            ))
            ->add('landline')
            ->add('phone')
            ->add('professionalphone')
            ->add('email', EmailType::class, [
                'required'     => false,
            ])
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
