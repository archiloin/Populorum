<?php
namespace App\Form\Client\Profil\Certifications\Langues\Type;

use App\Entity\Client\Profil\Certifications\Langues;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
          $builder
              ->add('langues', TextType::class, [
                  'required'     => true,
              ])
              ->add('lvl', TextType::class, [
                  'required'     => true,
              ])
              ->add('skill', TextType::class, [
                  'required'     => true,
              ])
              ->add('comment', TextType::class, [
                  'required'     => false,
              ])
          ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
      $resolver->setDefaults(array(
        'data_class' => Langues::class
      ));
    }
}
