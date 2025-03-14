<?php
namespace App\Form\Client\Security\Type;

use App\Form\Client\Security\Type\InscriptionProfilType;
use App\Entity\Client\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $plan = $this->plan = $options['plan'];
        $builder
            ->add('email', EmailType::class)
            ->add('profil', InscriptionProfilType::class, array(
                'label' => 'form.profil', 'translation_domain' => 'messages',
            ))
            ->add('plan', ChoiceType::class, [
                  'choices' => [
                      'Small' => 'Small',
                      'Medium' => 'Medium',
                      'Large' => 'Large',
                      'Large+' => 'Large+',
                    ],
                  'data'=> $options['plan'],
                  'choice_attr' => function() {
                       return ['checked' => 'checked'];
                  }
              ])
            ->add('cgu', CheckboxType::class)
            ;

        if (in_array('inscription', $options['validation_groups'])) {
            $builder
                ->add('plainPassword', RepeatedType::class, array(
                    'type' => PasswordType::class,
                    'first_options'  => array('label' => 'Password'),
                    'second_options' => array('label' => 'Confirm password'),
                ))
                ;
        } else {
            $builder
                ->add('plainPassword', RepeatedType::class, array(
                    'required' => false,
                    'type' => PasswordType::class,
                    'first_options'  => array('label' => 'Password'),
                    'second_options' => array('label' => 'Confirm password'),
                ))
                ;
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Utilisateur::class,
            'plan' => 0,
        ));
    }
}
