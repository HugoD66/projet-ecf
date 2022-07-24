<?php

namespace App\Controller;

use App\Entity\Recipe;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecipeController extends AbstractController
{
    #[Route('/recette/{id}', name: 'app_recipe')]
    public function index(ManagerRegistry $doctrine, int $id): Response
    {
        $recipe = $doctrine->getRepository(Recipe::class)->find($id);



        return $this->render('recipe/recipe-id.html.twig', [
            'title' => 'Mangez-Sain ! Recette',
             'id' => $recipe

        ]);
    }
}
