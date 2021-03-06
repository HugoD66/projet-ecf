<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $utilisateur = $this->getUser();

        $recipe = $doctrine->getRepository(Recipe::class)->findAll();

        return $this->render('home/home.html.twig', [
            'controller_name' => 'HomeController',
            'title' => 'Mangez-Sain!',
            'utilisateur' => $utilisateur,
            'recipes' => $recipe,
        ]);
    }
}
