<?php
namespace App\Form\Client\Support\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PJType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
        $builder->add('imageFile', VichImageType::class, [
            'label' => false,
            'required' => false,
        ]);
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'App\Entity\Client\Support\PJ'
    ));
  }
}
