<?php

namespace App\Controller;

use App\Entity\Recipe;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AllRecipeController extends AbstractController
{
    #[Route('/all-recipe', name: 'app_all_recipe')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $utilisateur = $this->getUser();
        $recipe = $doctrine->getRepository(Recipe::class)->findAll();

        return $this->render('recipe/all-recipe.html.twig', [
            'title' => 'Mangez-sain! Toutes les recettes.',
            'utilisateur' => $utilisateur,
            'recipes' => $recipe,


        ]);
    }

}
