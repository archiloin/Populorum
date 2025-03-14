<?php
namespace App\Form\Client\Profil\InformationsEntreprise\Type;

use App\Entity\Client\Profil\InformationsEntreprise\Logo;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class LogoType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
        $builder->add('imageFile', VichImageType::class, [
            'label' => false,
            'required' => false,
            'allow_delete' => true,
            'delete_label' => 'Delete?',
            'download_label' => 'Télécharger',
            'download_uri' => true,
            'image_uri' => false,
        ]);
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => Logo::class
    ));
  }
}
