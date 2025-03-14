<?php
namespace App\Form\Client\Profil\Personnes\Type;

use App\Entity\Client\Profil\Personnes\Profil;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
          $builder
              ->add('name', TextType::class, [
                  'required'     => true,
              ])
              ->add('relation', TextType::class, [
                  'required'     => true,
              ])
              ->add('dob', DateType::class, array(
                    'widget' => 'single_text',
                    'required' => false,
              ))
          ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
      $resolver->setDefaults(array(
        'data_class' => Profil::class
      ));
    }
}
