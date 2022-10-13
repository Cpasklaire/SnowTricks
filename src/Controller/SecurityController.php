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
//use App\Service\Mailer;

class SecurityController extends AbstractController
{
    private function generateToken()
    {
        return rtrim(strtr(base64_encode(random_bytes(32)), '+/', '-_'), '=');
    }

    #[Route('/singin', name: 'registration')]
    public function registration(Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $passwordHasher): Response {
        $user = new User();
        $form = $this->createForm(FormUserType::class, $user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {

            //date et activation
            $user->setCreatedAte(new \DateTime());
            $user->setActivate(false);
            //password
            $plaintextPassword = $user->getPassword();
            $hashedPassword = $passwordHasher->hashPassword($user,$plaintextPassword);
            $user->setPassword($hashedPassword);
            //token
            $user->setToken($this->generateToken());

            $manager->persist($user);
            $manager->flush();

            //mail d'activation
            $to = $user->getEmail();
            $subject = "";
            $token = $user->getToken();
            $message = "blablabla $token blablabla";
            mail($to, $subject, $message);

            $this->addFlash("flash", "Inscription réussie ! Vérifiez votre boîte mail pour activer votre compte.");

            return $this->redirectToRoute('login');
        }

        return $this->render('security/singin.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/confirmer-mon-compte/{token}', name: 'confirm_account')]
    public function confirmAccount(string $token, EntityManagerInterface $manager)
    {
        $user = $this->userRepository->findOneBy(["token" => $token]);

        if($user) {
            $user->setToken(null);
            $user->setActivate(true);

            $manager->persist($user);
            $manager->flush();

            $this->addFlash("flash", "Compte actif ! Connectez vous ! ");
            return $this->redirectToRoute("login");
        } else {
            $this->addFlash("flash", "Ce compte n'exsite pas");
            return $this->redirectToRoute('home');
        }
    }


    #[Route('/login', name: 'login')]
    public function login() {

        return $this->render('security/login.html.twig');
    }

    #[Route('/logout', name: 'logout')]
    public function logout() {}
}
