<?php

namespace App\Controller;

use App\Entity\ContactUs;
use App\Form\ContactUsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactUsController extends AbstractController
{
    #[Route('/contact-us', name: 'app_contact_us')]
    public function index(Request $request,  EntityManagerInterface $entityManager): Response
    {
        $utilisateur = $this->getUser();

        $contactus = new ContactUs();

        $form = $this->createForm(ContactUsType::class, $contactus);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $contactus = $form->getData();

            $entityManager->persist($contactus);
            $entityManager->flush();

            return $this->redirectToRoute('app_home');

        }

        return $this->render('registration/contact-us.html.twig', [
            'title' => 'Mangez-Sain! Nous contacter',
            'form' => $form->createView(),
            'utilisateur' => $utilisateur,
        ]);
    }
}
