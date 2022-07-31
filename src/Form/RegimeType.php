<?php

namespace App\Form;

use App\Entity\Regime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegimeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre du régime : ',
                'attr' => array(
                    'placeholder' => 'Sporadique')
            ])
            ->add('description', TextType::class, [
                'attr' => array(
                    'placeholder' => ' Le débutant, qu\'est-ce qu\'il fait ? Il attrape le fenouil par la tige, et essaye de donner des coups avec la partie sporadique.')
            ])
            ->add('save', SubmitType::class, array(
                'label' => 'Création Régime',
                'attr' => array('class' => 'button-33')
            ));

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Regime::class,
        ]);
    }
}
