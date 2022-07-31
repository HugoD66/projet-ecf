<?php

namespace App\Form;

use App\Entity\Allergene;
use App\Entity\Recipe;
use App\Entity\Regime;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateRecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre du plat : ',
                'attr' => array(
                    'placeholder' => 'Un plat sympa')
            ])
            ->add('description', TextType::class, [
                'attr' => array(
                    'placeholder' => 'Topping gummi bears marzipan dessert brownie liquorice biscuit jelly beans chocolate bar. Brownie lollipop marshmallow lemon drops bear claw pastry sweet roll caramels. Oat cake cake ice cream macaroon tiramisu chocolate bar jujubes wafer. Cotton candy tootsie roll carrot cake cheesecake cookie brownie tiramisu shortbread. Sesame snaps dragée cookie jelly-o sweet roll. ')
            ])
            ->add('cookingTime', TextType::class, [
                'label' => 'Temps de préparation :',
                'attr' => array(
                    'placeholder' => 10
                )
            ])
            ->add('cookingRest', TextType::class, [
                'label' => 'Temps de repos :',
                'attr' => array(
                    'placeholder' => 40
                )
            ])
            ->add('heatTime', TextType::class, [
                'label' => 'Temps de cuisson :',
                'attr' => array(
                    'placeholder' => 40
                )
            ])
            ->add('ingredients', TextType::class, [
                'label' => 'Ingrédients necessaires :',
                'attr' => array(
                    'placeholder' => 'Mais, Riz, Ananas .... '
                )
            ])
            ->add('steps', TextType::class, [
                'label' => 'Nombre d\'étapes :',
                'attr' => array(
                    'placeholder' => 6
                )
            ])
            ->add('regimeList', EntityType::class, [
                'class' => Regime::class,
                'expanded' => true,
                'multiple' => true,
                'required' => false,
                'empty_data'=>true,
            ])

            ->add('picture', FileType::class, [
                'required' => false,
                'mapped' => false,
                'label' => 'Une photo du plat ? '

            ])
            ->add('allergene', EntityType::class, [
                'class' => Allergene::class,
                'expanded' => true,
                'multiple' => true,
                'required' => false,
                'empty_data'=>true,
                'mapped' => false,
                'label' => 'Allergènes contenu dans le plat :'

            ])

            ->add('isAccessibleUser', CheckboxType::class, [
                'label' => 'Accessible seulement pour les Patients ? ',
                'attr' => array(
                    'class' => 'checkboxTest')
            ])
            ->add('save', SubmitType::class, array(
                'label' => 'Création Allergène',
                'attr' => array(
                    'class' => 'button-33')
            ));
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}
