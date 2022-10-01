<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\AsciiSlugger;

use Doctrine\ORM\EntityManagerInterface; //objetmanager

use App\Entity\Trick;
use App\Repository\TrickRepository;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use App\Form\FormTrickType;

class TrickController extends AbstractController
{
    //view all tricks
    #[Route('/', name: 'home')]
    public function home(trickRepository $trickRepo): Response
    {
        $tricks = $trickRepo->findAll();
        return $this->render('home.html.twig', ['tricks' => $tricks,]);
    }

    //view one trick
    #[Route('/trick/{slug}', name: 'trick')]
    public function trick($slug, TrickRepository $trickRepo): Response
    {
        $trick = $trickRepo->findOneBy(['slug' => $slug]);
        return $this->render('trick/trick.html.twig', ['trick' => $trick,]);
    }

    //create and edit one trick
    #[Route('/newTrick', name: 'newTrick')]
    #[Route('/trick/{slug}/edit', name: 'editTrick')]
    public function formTrick(Trick $trick = null, Request $request, EntityManagerInterface $manager): Response
    {
        if(!$trick){
            $trick = new Trick();
        }

        $form = $this->createForm(FormTrickType::class, $trick);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            if(!$trick->getId()){
            $trick->setCreatDate(new \DateTime());                
            }

            $trick->setUpDating(new \DateTime());  
            $slugger = new AsciiSlugger();
            $slug = $slugger->slug($setName);
            $trick->setSlug($slug);

            $manager->persist($trick);
            $manager->flush();

            return $this->redirectToRoute('trick', ['slug' => $trick->getSlug()]);

        }

        return $this->render('trick/creat.html.twig', ['formCreatTrick' => $form->createView(), 'editMode' => $post->getId() !== null]);
    }
}
