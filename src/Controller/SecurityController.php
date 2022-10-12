<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\FormUserType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SecurityController extends AbstractController
{
    #[Route('/singin', name: 'registration')]
    public function registration(Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $passwordHasher) {
        $user = new User();
        $form = $this->createForm(FormUserType::class, $user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {

            $user->setCreatedAte(new \DateTime());

            $plaintextPassword = $user->getPassword();
            $hashedPassword = $passwordHasher->hashPassword($user,$plaintextPassword);
            $user->setPassword($hashedPassword);

            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('login');
        }

        return $this->render('security/auth.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/login', name: 'login')]
    public function login() {

        return $this->render('security/login.html.twig');
    }

    #[Route('/logout', name: 'logout')]
    public function logout() {}
}
