<?php

namespace App\Controller;

use App\Services\MailerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\FormUserType;
use App\Form\FormPassType;
use App\Form\FormValidType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use App\Repository\UserRepository;
use Symfony\Component\Security\Http\LoginLink\LoginLinkHandlerInterface;
use Symfony\Component\Security\Http\LoginLink\LoginLinkNotification;
use Symfony\Component\Notifier\Recipient\Recipient;
use Symfony\Component\Notifier\NotifierInterface;


class SecurityController extends AbstractController
{
    private function generateToken()
    {
        return rtrim(strtr(base64_encode(random_bytes(32)), '+/', '-_'), '=');
    }

    #[Route('/singin', name: 'registration')]
    public function registration(Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $passwordHasher, MailerService $mailer): Response {
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
            $userToken = $user->getToken();
            $message = '<h1>Confirmez votre compte pour vous connectez</h1>
            <a href="https://127.0.0.1:8000/confirmer-mon-compte/'.$userToken.'">Cliquez ici ! </a>'
            ;

            $mailer->sendEmail(from: 'no-reply@swontrick.fr ', to: $user->getEmail(), subject: "Activation du compte Swon Tricks !", content: $message);

            $this->addFlash("flash", "Inscription réussie ! Vérifiez votre boîte mail pour activer votre compte.");
            return $this->redirectToRoute('login');
        }

        return $this->render('security/singin.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/confirmer-mon-compte/{token}', name: 'confirm_account')]
    public function confirmAccount(string $token, Request $request, EntityManagerInterface $manager, UserRepository $userRepo)
    { 
        $user = $userRepo->findOneBy(['token' => $token]);

        if($user){
            $user->setToken(null)
                ->setActivate(true);

            $manager->persist($user);
            $manager->flush();

            $this->addFlash("flash", "Compte actif ! Connectez vous ! ");
            return $this->redirectToRoute("login");
        } 
        else{
            $this->addFlash("flash", "Aucun compte trouver");
            return $this->redirectToRoute("login");
        }
    }

    #[Route('/logout', name: 'logout')]
    public function logout() {}

    #[Route('/login', name: 'login')]
    public function login() {
        return $this->render('security/login.html.twig');
    }    
    
    #[Route('/login_check', name: 'login_check')]
    public function login_check() {
    }    
    
    
    #[Route('/forgot-pass', name: 'forgot-pass')]
    public function forgotPass(Request $request, UserRepository $userRepo, EntityManagerInterface $manager, UserPasswordHasherInterface $passwordHasher, MailerService $mailer)
    {

        if ($request->isMethod('POST')) {

            $email = $request->request->get('email');
            $user = $userRepo->findOneBy(['email' => $email]);
            if($user){
                $user->setToken($this->generateToken());
                $manager->persist($user);
                $manager->flush();

                $userToken = $user->getToken();
                $message = '<h1>Changer votre mot de passe</h1>
                <a href="https://127.0.0.1:8000/connectToken/'.$userToken.'">Cliquez ici ! </a>'
                ;

                $recipient = new Recipient($user->getEmail());
                $mailer->sendEmail(from: 'no-reply@swontrick.fr ', to: $user->getEmail(), subject: "Mot de passe perdu !", content: $message);
                
                $this->addFlash("flash", "Un mail viens de vous être envoyé.");
                return $this->redirectToRoute("login");
            }
        }
        return $this->render('security/forgotPassword.html.twig');
    }

    #[Route('/connectToken/{token}', name: 'connectToken')] // mdp persu
    public function connectToken(string $token, Request $request, EntityManagerInterface $manager, UserRepository $userRepo)
    { 
        $user = $userRepo->findOneBy(['token' => $token]);

        if($user){
            $user->setToken(null);

            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute("changeMDP", ['pseudo' => $user->getPseudo()]);
        }
    }

    #[Route('/change-passeword/{pseudo}', name: 'changeMDP')]
    public function changeMDP($pseudo, UserRepository $userRepo, Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $passwordHasher): Response {

        $user = $userRepo->findOneBy(['Pseudo' => $pseudo]);
        $form = $this->createForm(FormPassType::class, $user);

        $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()) {

                //password
                $plaintextPassword = $user->getPassword();
                $hashedPassword = $passwordHasher->hashPassword($user,$plaintextPassword);
                $user->setPassword($hashedPassword);

                $manager->persist($user);
                $manager->flush();

                $this->addFlash("flash", "Mot de passe modifier, connectez vous ! ");
                return $this->redirectToRoute('login');
            }

        return $this->render('security/changeMDP.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
