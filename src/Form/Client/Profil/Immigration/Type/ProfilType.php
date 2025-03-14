<?php
namespace App\Form\Client\Profil\Immigration\Type;

use App\Entity\Client\Profil\Immigration\Profil;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;

class ProfilType extends AbstractType
{
    const PASSEPORT = 'Passeport';
    const VISA = 'Visa';

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
          $builder
              ->add('document', ChoiceType::class, array(
              'choices'  => array(
                  'Passeport' => self::PASSEPORT,
                  'Visa' => self::VISA,
                ),
              'expanded'     => true,
              'multiple'     => false,
            ))
              ->add('number', TextType::class, [
                  'required'     => true,
              ])
              ->add('publish', DateType::class, array(
                    'widget' => 'single_text',
                    'required' => false,
              ))
              ->add('exp', DateType::class, array(
                    'widget' => 'single_text',
                    'required' => false,
              ))
              ->add('statut', TextType::class, [
                  'required'     => false,
              ])
              ->add('publishedby', CountryType::class, array(
                  'preferred_choices' => array('GB', 'FR', 'ES', 'US', 'BE', 'DE'),
                  'choice_translation_locale' => null,
              ))
              ->add('eval', DateType::class, array(
                    'widget' => 'single_text',
                    'required' => false,
              ))
              ->add('comment', TextType::class, [
                  'required'     => false,
              ])
          ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
      $resolver->setDefaults(array(
        'data_class' => Profil::class
      ));
    }
}
