<?php
namespace App\Form\Client\Profil\Certifications\Etudes\Type;

use App\Entity\Client\Profil\Certifications\Etudes;

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
              ->add('lvl', TextType::class, [
                  'required'     => true,
              ])
              ->add('institute', TextType::class, [
                  'required'     => false,
              ])
              ->add('speciality', TextType::class, [
                  'required'     => false,
              ])
              ->add('result', TextType::class, [
                  'required'     => false,
              ])
              ->add('start', DateType::class, array(
                    'widget' => 'single_text',
                    'required' => false,
              ))
              ->add('end', DateType::class, array(
                    'widget' => 'single_text',
                    'required' => false,
              ))
          ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
      $resolver->setDefaults(array(
        'data_class' => Etudes::class
      ));
    }
}
