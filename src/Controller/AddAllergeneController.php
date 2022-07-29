<?php

namespace App\Controller;

use App\Entity\Allergene;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddAllergeneController extends AbstractController
{
    #[Route('/add-allergene', name: 'app_add_allergene')]
    public function index(Request $request, ManagerRegistry $doctrine, EntityManagerInterface $entityManager): Response
    {
        $allergenes = $doctrine->getRepository(Allergene::class)->findAll();

        $allergene = new Allergene();
        $allergene->addTitle()->setTitle('test');
        $allergene->setDescription('test');

        $entityManager->persist($allergene);
        $entityManager->flush();

        return $this->render('add_recipe/add-allergene.html.twig', [
            'controller_name' => 'AddAllergeneController',
            'title' => 'Mangez-Sain! Ajout allérgene',
            'data_class' => Allergene::class,
            'allergeneLists' => $allergenes,
        ]);
    }
}
