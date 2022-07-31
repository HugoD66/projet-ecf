<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Form\CreateRecipeType;
use ContainerB8xASZ1\getRecipeRepositoryService;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\File;

class AddRecipeController extends AbstractController
{
    #[Route('/add-recipe', name: 'app_add_recipe')]
    public function new(ManagerRegistry $doctrine, EntityManagerInterface $entityManager, Request $request, SluggerInterface $slugger): Response
    {

        $utilisateur = $this->getUser();
        $recipes = $doctrine->getRepository(Recipe::class)->getRecipe();


        $recipe = new Recipe();
        $form = $this->createForm(CreateRecipeType::class, $recipe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $picturefile = $form->get('picture')->getData();
            if ($picturefile) {
                $originalFilename = pathinfo($picturefile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$picturefile->guessExtension();
                try {
                    $picturefile->move(
                        $this->getParameter('recipe-picture'),
                        $newFilename
                    );
                } catch (FileException $e) {
                }
                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $recipe->setPicture($newFilename);
                $entityManager->persist($recipe);
                $entityManager->flush();
            }
            return $this->redirectToRoute('app_home');

        }


        return $this->renderForm('add_recipe/add-recipe.html.twig', [
            'form' => $form,
            'recipe' => $recipe,
            'utilisateur' => $utilisateur,
            'recipes' => $recipes,
            'title' => 'Mangez-sain! Ajout d\'une recette'

        ]);
    }
}


