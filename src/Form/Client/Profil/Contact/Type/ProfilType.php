<?php
namespace App\Form\Client\Profil\Contact\Type;

use App\Entity\Client\Profil\Contact\Profil;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
              ->add('landline')
              ->add('phone')
              ->add('professionalphone')
          ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
      $resolver->setDefaults(array(
        'data_class' => Profil::class
      ));
    }
}
