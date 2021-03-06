<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PatientController extends AbstractController
{
    #[Route('/patient', name: 'app_patient')]
    public function index(): Response
    {
        $utilisateur = $this->getUser();

        return $this->render('gestion/patient.html.twig', [
            'utilisateur' => $utilisateur,
            'title' => 'Mangez-sain! Profil Patient',
        ]);
    }
}
