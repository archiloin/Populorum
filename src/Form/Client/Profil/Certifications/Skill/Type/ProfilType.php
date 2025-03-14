<?php
namespace App\Form\Client\Profil\Certifications\Skill\Type;

use App\Entity\Client\Profil\Certifications\Skill;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
          $builder
              ->add('skill', TextType::class, [
                  'required'     => true,
              ])
              ->add('yearsExp', TextType::class, [
                  'required'     => false,
              ])
              ->add('comment', TextType::class, [
                  'required'     => false,
              ])
          ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
      $resolver->setDefaults(array(
        'data_class' => Skill::class
      ));
    }
}
