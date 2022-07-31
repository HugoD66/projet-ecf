<?php

namespace App\Form;

use App\Entity\Allergene;
use App\Entity\Regime;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AllergeneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre de l\'allergène : ',
                'attr' => array(
                    'placeholder' => 'La couleur pleutre')
            ])
            ->add('description', TextType::class, [
                'attr' => array(
                    'placeholder' => ' La chevalerie, c\'est pas là où on range les chevaux ?')
            ])
            ->add('recip_allergene', EntityType::class, array(
                'class' => Regime::class,
                'expanded' => true,
                'multiple' => true,
                'required' => false,
                'empty_data'=>true,
                'mapped' => false,
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Création Allergène',
                'attr' => array('class' => 'button-33')
            ));
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Allergene::class,
        ]);
    }
}
