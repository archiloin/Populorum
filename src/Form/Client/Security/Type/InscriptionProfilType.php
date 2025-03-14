<?php
namespace App\Form\Client\Security\Type;

use App\Entity\Client\Profil\Index;
use App\Form\Client\Security\Type\InscriptionProfilInfoType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('informationsEntreprise', InscriptionProfilInfoType::class, array(
                'label' => 'form.profil', 'translation_domain' => 'messages',
            ));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Index::class,
        ));
    }
}
