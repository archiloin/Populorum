<?php
namespace App\Form\Client\Conge\Type;

use App\Entity\Client\Conge\Absence;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ModifierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isActive', ChoiceType::class, [
                  'choices' => [
                      'Accepter' => true,
                      'Refuser' => false
                  ]
              ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Absence::class,
        ));
    }
}
