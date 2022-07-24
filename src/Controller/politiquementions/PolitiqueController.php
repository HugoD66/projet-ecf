<?php

namespace App\Controller\politiquementions;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PolitiqueController extends AbstractController
{
    #[Route('/politique-confidentialitee', name: 'app_politique')]
    public function index(): Response
    {
        return $this->render('politiquesmentions/politique.html.twig', [
            'controller_name' => 'PolitiqueController',
            'title' => 'Mangez-Sain! Politique de confidentialitée'
        ]);
    }
}
