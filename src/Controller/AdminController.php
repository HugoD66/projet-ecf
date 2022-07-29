<?php

namespace App\Controller;

use App\Entity\ContactUs;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin/{id}', name: 'app_admin')]
    public function index(ManagerRegistry $doctrine,int $id): Response
    {
        $user = $this->getUser();

        $user = $doctrine->getRepository(User::class)->find($id);
        $contact = $doctrine->getRepository(ContactUs::class)->getContactUsList();

        return $this->render('profil/profil.html.twig', [
            'title' => 'Mangez-Sain! Profil',
            'user' => $user,
            'contact' => $contact
            ]);
    }
    #[Route('/admin/contact-us/{id}', name: 'delete_form')]
    public function remove(ManagerRegistry $doctrine,int $id): Response
    {

        $entityManager = $doctrine->getRepository(ContactUs::class)->getContactUsList();

        $contact = $entityManager->getRepository(ContactUs::class)->findOneBy(['id' => $id]);
        $entityManager->remove($contact);
        $entityManager->flush();

        return $this->redirectToRoute('app_admin');
    }
}
