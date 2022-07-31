<?php

namespace App\Controller;

use App\Entity\Recipe;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AlleRecipeExeptController extends AbstractController
{
    #[Route('/all-recipe-exept', name: 'app_alle_recipe_exept')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $utilisateur = $this->getUser();
        $recipe = $doctrine->getRepository(Recipe::class)->findAll();


        return $this->render('recipe/all_recipe_exept.html.twig', [
            'title' => 'Mangez-sain! Recettes pour utilisateur.',
            'utilisateur' => $utilisateur,
            'recipes' => $recipe,
            ]);
    }
}


