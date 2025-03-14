<?php
namespace App\Form\Client\Profil\Certifications\PieceJointe\Type;

use App\Entity\Client\Profil\Certifications\PieceJointe;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PieceJointeType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
        $builder
            ->add('imageFile', VichImageType::class)
            ->add('commentaire', TextareaType::class, [
                'required' => false,
            ]);
}

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => PieceJointe::class
    ));
  }
}
