<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\CreatePatientType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class CreatePatientController extends AbstractController
{
    #[Route('/admin/{id}/create-patient', name: 'create-patient')]
    public function new(ManagerRegistry $doctrine, Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, int $id): Response
    {
        $utilisateur = $this->getUser();
        $user = $doctrine->getRepository(User::class)->find($id);



        $user = new User();
        $form = $this->createForm(CreatePatientType::class, $user);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $user->setRoles(array('ROLE_PATIENT'));


            $entityManager->persist($user);
            $entityManager->flush();
        }
        return $this->render('registration/create-patient.html.twig', [
            'registrationForm' => $form->createView(),
            'title' => 'Mangez-sain! Creation Patient',
            'utilisateur' => $utilisateur
        ]);
    }
}
