<?php

namespace App\Controller;

use App\Entity\Allergene;
use App\Form\AllergeneType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormTypeInterface;

class AddAllergeneController extends AbstractController
{
    #[Route('/add-allergene', name: 'app_add_allergene')]
    public function index(ManagerRegistry $doctrine, EntityManagerInterface $entityManager, Request $request): Response
    {

        $utilisateur = $this->getUser();
        $allergenes = $doctrine->getRepository(Allergene::class)->findAll();

        $allergene = new Allergene();
        $form = $this->createForm(AllergeneType::class, $allergene);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $allergene = $form->getData();


        }
        return $this->render('add_recipe/add-allergene.html.twig', [
            'controller_name' => 'AddAllergeneController',
            'title' => 'Mangez-Sain! Ajout allérgene',
            'data_class' => Allergene::class,
            'allergeneLists' => $allergenes,
            'utilisateur' => $utilisateur,
            'form' => $form->createView(),


        ]);
    }
}
