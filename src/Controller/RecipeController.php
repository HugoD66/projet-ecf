<?php

namespace App\Controller;

use App\Entity\Allergene;
use App\Entity\Commentaire;
use App\Entity\Recipe;
use App\Form\CommentaireType;
use App\Form\ContactUsType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecipeController extends AbstractController
{
    #[Route('/recette/{id}', name: 'app_recipe')]
    public function index(ManagerRegistry $doctrine, int $id, EntityManagerInterface $entityManager, Request $request): Response
    {
        $recipe = $doctrine->getRepository(Recipe::class)->find($id);

        $utilisateur = $this->getUser();
        $allergene = $doctrine->getRepository(Allergene::class)->find($id);

        $commentaire = new Commentaire();
        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $commentaire = $form->getData();
            $entityManager->persist($commentaire);
            $entityManager->flush();

        }
            return $this->render('recipe/recipe-id.html.twig', [
            'title' => 'Mangez-Sain ! Recette',
             'id' => $recipe,
            'utilisateur' => $utilisateur,
            'allergene' => $allergene,
            'form' => $form->createView(),
        ]);
    }
}
