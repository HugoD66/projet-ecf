<?php

namespace App\Controller;

use App\Entity\Allergene;
use App\Entity\Recipe;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddRegimeController extends AbstractController
{
    #[Route('/add-regime', name: 'app_add_regime')]
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {



        $allergene = new Allergene();
        $allergene->addTitle('test');






        $entityManager = $doctrine->getManager();
        $entityManager->persist($allergene);
        $entityManager->flush();


        return $this->render('add-regime.html.twig', [
            'title' => 'Mangez-Sain! Ajout régime',
            'controller_name' => 'AddRegimeController',
            'data_class' => Allergene::class,

        ]);
    }
}
