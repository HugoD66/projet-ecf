<?php

namespace App\Controller\politiquementions;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MentionsLegalesController extends AbstractController
{
    #[Route('/mentions-legales', name: 'app_mentions_legales')]
    public function index(): Response
    {
        return $this->render('politiquesmentions/mentions.html.twig', [
            'controller_name' => 'MentionsLegalesController',
            'title' => 'Mention légales Mangez-Sain!'
        ]);
    }
}
