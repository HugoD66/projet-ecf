<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RedirectRegisterController extends AbstractController
{
    #[Route('/redirect-register', name: 'app_redirect_register')]
    public function index(): Response
    {
        $utilisateur = $this->getUser();

        return $this->render('registration/redirectregister.html.twig', [
            'controller_name' => 'RedirectRegisterController',
            'title' => 'Mangez-Sain! Redirection Enregistrement',
            'utilisateur' => $utilisateur,


        ]);
    }
}
