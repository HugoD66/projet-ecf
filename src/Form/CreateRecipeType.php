<?php

namespace App\Form;

use App\Entity\Allergene;
use App\Entity\Hotel;
use App\Entity\Recipe;
use App\Entity\Regime;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateRecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('cookingTime')
            ->add('cookingRest')
            ->add('heatTime')
            ->add('ingredients')
            ->add('steps')
            ->add('regimeList', EntityType::class, [
        'class' => Regime::class
            ])
            ->add('picture', FileType::class, [
                'required' => false,
                'mapped' => false,

            ])
            ->add('allergene', EntityType::class, [
                'class' => Allergene::class,
                'mapped' => false,

            ])
            ->add('save', SubmitType::class);

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}
