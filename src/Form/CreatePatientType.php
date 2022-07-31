<?php

namespace App\Form;

use App\Entity\Allergene;
use App\Entity\Regime;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class CreatePatientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', TextType::class, [
                'label' => 'Votre email : ',
                'attr' => array(
                    'placeholder' => 'jaimebienlespatates@exemple.com')
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'label' => 'Accepter les thermes du contrat',
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter les thermes du contrat.',
                    ]),
                ],
            ])
            ->add('username', TextType::class, [
                'label' => 'Votre nom d\'utilisateur : ',
                'attr' => array(
                    'placeholder' => 'Dubois')
            ])
            ->add('regime', EntityType::class, array(
                'class' => Regime::class,
                'expanded' => true,
                'multiple' => true,
                'required' => false,
                'empty_data'=>true,
                'mapped' => false,

            ))
            ->add('allergenes', EntityType::class,
                array(
                    'expanded' => true,
                    'multiple' => true,
                    'empty_data'=>true,
                    'class' => Allergene::class,
                    'mapped' => false,
                ))
            ->add('plainPassword', PasswordType::class, [
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit contenir au moins  {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('save', SubmitType::class, array(
                'label' => 'Creer Patient',
                'attr' => array('class' => 'button-33')
            ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
