<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\FormUserType;
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
    public function registration(Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $passwordHasher, MailerInterface $mailer): Response {
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
            $email = (new Email())
            ->from('sasha.leroux92@gmail.com')
            ->to($user->getEmail())
            ->subject('Bienvenue sur Show Tricks')
            ->text('blablabla $token blablabla');
            $mailer->send($email);


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

        $formValid = $this->createForm(FormValidType::class, $user);
        $formValid->handleRequest($request);

        if($formValid->isSubmitted() && $formValid->isValid()){
            $user->setToken(null)
                ->setActivate(true);

            $manager->persist($user);
            $manager->flush();

            $this->addFlash("flash", "Compte actif ! Connectez vous ! ");
            return $this->redirectToRoute("login");
        } 
        return $this->render('security/confirmToken.html.twig', [
            'formValid' => $formValid->createView()
        ]);
    }

    #[Route('/login_check', name: 'login_check')]
    public function login_check() {
    }

    #[Route('/logout', name: 'logout')]
    public function logout() {}

    #[Route('/forgot-pass', name: 'forgot-pass')] // email configuration
    public function requestLoginLink(NotifierInterface $notifier, LoginLinkHandlerInterface $loginLinkHandler, UserRepository $userRepository, Request $request)
    {
        // check if login form is submitted
        if ($request->isMethod('POST')) {
            // load the user in some way (e.g. using the form input)
            $email = $request->request->get('email');
            $user = $userRepository->findOneBy(['email' => $email]);

            // create a login link for $user this returns an instance
            // of LoginLinkDetails
            $loginLinkDetails = $loginLinkHandler->createLoginLink($user);
            $loginLink = $loginLinkDetails->getUrl();

            $notification = new LoginLinkNotification(
                $loginLinkDetails,
                'Welcome to MY WEBSITE!' // email subject
            );
            // create a recipient for this user
            $recipient = new Recipient($user->getEmail());

            // send the notification to the user
            $notifier->send($notification, $recipient);

            // render a "Login link is sent!" page
            return $this->render('security/login_link_sent.html.twig');

        }
        return $this->render('security/forgotPassword.html.twig');
    }

    #[Route('/login', name: 'login')]
    public function login() {
        /* SAM seule user.activate = true peuvent ce connecter */
        return $this->render('security/login.html.twig');
    }
}
