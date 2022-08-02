<?php

namespace App\Form;

use App\Entity\Commentaire;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('note', CheckboxType::class, [
                'label' => 'Notez cette recette : '
            ])
            ->add('commentaire', TextType::class, [
                'label' => 'Votre commentaire : '
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
            'data_class' => Commentaire::class,
        ]);
    }
}
