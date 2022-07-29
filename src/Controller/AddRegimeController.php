<?php

namespace App\Controller;

use App\Entity\Regime;
use App\Form\RegimeType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormBuilderInterface;

class AddRegimeController extends AbstractController
{
    #[Route('/add-regime', name: 'app_add_regime')]
    public function index(Request $request, ManagerRegistry $doctrine, EntityManagerInterface $entityManager): Response
    {


        $utilisateur = $this->getUser();

        $regimeList = $doctrine->getRepository(Regime::class)->findAll();

        $regime = new Regime();
        $form = $this->createForm(RegimeType::class, $regime);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $regime = $form->getData();

        }
        return $this->render('add_recipe/add-regime.html.twig', [
            'title' => 'Mangez-Sain! Ajout régime',
            'controller_name' => 'AddRegimeController',
            'data_class' => Regime::class,
            'regimeLists' => $regimeList,
            'utilisateur' => $utilisateur,
            'form' => $form->createView(),
        ]);
    }
}
