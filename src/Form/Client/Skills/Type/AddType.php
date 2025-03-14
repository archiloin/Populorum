<?php
namespace App\Form\Client\Skills\Type;

use App\Entity\Client\Skills\Skills;
use App\Entity\Client\Skills\Criteria;
use App\Form\Client\Skills\Type\AddType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AddType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Name',
              ])
            ->add('criteres', CollectionType::class, [
                'entry_type' => CriteriaType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'prototype'=> true,
                'by_reference'  => false,
                'label' => false,
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Skills::class,
        ));
    }
}
