<?php

namespace App\Controller;

use App\Entity\ContactUs;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    #[Route('/user/{id}', name: 'app_profil')]
    public function index(ManagerRegistry $doctrine,int $id): Response
    {
        $user = $doctrine->getRepository(User::class)->find($id);
        $contact = $doctrine->getRepository(ContactUs::class)->getContactUsList();

        return $this->render('profil/profil.html.twig', [
            'title' => 'Mangez-Sain! Profil',
            'user' => $user,
            'contact' => $contact
            ]);
    }

    #[Route('/user/contact-us/{id}', name: 'delete_form')]
    public function remove(ManagerRegistry $doctrine,  $id): Response
    {

        $user = $doctrine->getRepository(User::class)->find($id);


        $entityManager = $doctrine->getManager();
        $contact = $entityManager->getRepository(ContactUs::class)->findOneBy(['id' => $id]);
        $entityManager->remove($contact);
        $entityManager->flush();

        return $this->redirectToRoute('app_home');
    }

}
