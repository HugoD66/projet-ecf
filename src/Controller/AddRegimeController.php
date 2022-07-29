<?php

namespace App\Controller;

use App\Entity\Allergene;
use App\Entity\Recipe;
use App\Entity\Regime;
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



        $regimeList = $doctrine->getRepository(Regime::class)->findAll();

        return $this->render('add_recipe/add-regime.html.twig', [
            'title' => 'Mangez-Sain! Ajout régime',
            'controller_name' => 'AddRegimeController',
            'data_class' => Regime::class,
            'regimeLists' => $regimeList,

        ]);
    }
}
