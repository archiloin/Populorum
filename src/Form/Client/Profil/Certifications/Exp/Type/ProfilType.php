<?php
namespace App\Form\Client\Profil\Certifications\Exp\Type;

use App\Entity\Client\Profil\Certifications\Exp;

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
              ->add('business', TextType::class, [
                  'required'     => true,
              ])
              ->add('job', TextType::class, [
                  'required'     => true,
              ])
              ->add('start', DateType::class, array(
                    'widget' => 'single_text',
                    'required' => false,
              ))
              ->add('end', DateType::class, array(
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
        'data_class' => Exp::class
      ));
    }
}
