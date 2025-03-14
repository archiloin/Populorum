<?php
namespace App\Form\Client\Skills\Type;

use App\Entity\Client\Skills\Criteria;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Contracts\Translation\TranslatorInterface;

class CriteriaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Name of competency:',
              ])
            ->add('acquired', TextType::class, [
                'label' => 'Acquired value (0 - 100):',
              ])
            ->add('toAcquire', TextType::class, [
                'label' => 'Value to acquire (0 - 100):',
              ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Criteria::class,
        ));
    }
}
