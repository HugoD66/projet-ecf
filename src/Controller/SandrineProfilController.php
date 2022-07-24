<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SandrineProfilController extends AbstractController
{
    #[Route('/sandrine/profil', name: 'app_sandrine_profil')]
    public function index(): Response
    {
        return $this->render('sandrine_profil/sandrine_profil.html.twig', [
            'controller_name' => 'SandrineProfilController',
            'title' => 'Mangez-sain! Profil Sandrine'
        ]);
    }
}
