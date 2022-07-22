<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DejaInscritController extends AbstractController
{
    #[Route('/deja-inscrit', name: 'app_deja_inscrit')]
    public function index(): Response
    {
        return $this->render('registration/dejainscrit.html.twig', [
            'controller_name' => 'DejaInscritController',
        ]);
    }
}
