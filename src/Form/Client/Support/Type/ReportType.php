<?php
namespace App\Form\Client\Support\Type;

use App\Form\Client\Support\Type\PJType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ReportType extends AbstractType
{

    /* - Sujet - */
    const ERROR = 'Have you encountered an error?';
    const MALFUNCTION = 'Malfunction?';
    const SUGGESTION = 'A suggestion?';
    const PARTNERSHIP = 'Partnership';
    const OTHER = 'Other';

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sujet', ChoiceType::class, [
                      'choices'  => [
                          'Have you encountered an error?' => self::ERROR,
                          'Malfunction?' => self::MALFUNCTION,
                          'A suggestion?' => self::SUGGESTION,
                          'Partnership' => self::PARTNERSHIP,
                          'Other' => self::OTHER,
                          ],
                      'expanded'  => false,
                      'multiple'  => false,
                  ])
            ->add('description', TextareaType::class)
            ->add('pj', PJType::class)
        ;


    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Client\Support\Report'
        ));
    }

}
