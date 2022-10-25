<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\AsciiSlugger;

use Doctrine\ORM\EntityManagerInterface; //objetmanager

use App\Entity\Trick;
use App\Entity\Media;
use App\Entity\Comment;
use App\Repository\TrickRepository;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use App\Form\FormTrickType;
use App\Form\FormMediaType;
use App\Form\FormCommentType;

class TrickController extends AbstractController
{
    //view all tricks
    #[Route('/', name: 'home')]
    public function home(trickRepository $trickRepo): Response
    {
        $tricks = $trickRepo->findAll();
        return $this->render('home.html.twig', [
            'tricks' => $tricks, 
        ]);
    }

    //view one trick and creat and view comments
    #[Route('/trick/{slug}', name: 'trick')]
    public function trick($slug, TrickRepository $trickRepo, Request $request, EntityManagerInterface $manager): Response
    {   
        $trick = $trickRepo->findOneBy(['slug' => $slug]);
        
        //creat comment
        $comment = new Comment();
        $commentForm = $this->createForm(FormCommentType::class, $comment);
        $commentForm->handleRequest($request);
        if($commentForm->isSubmitted() && $commentForm->isValid()){
            $comment->setCreatedAte(new \DateTime())
                    ->setTrickRelation($trick)
                    ->setCreatedUser($this->getUser());
            $manager->persist($comment);
            $manager->flush();
            return $this->redirectToRoute('trick', ['slug' => $trick->getSlug()]);
        }
 
        return $this->render('trick/trick.html.twig', [
            'trick' => $trick,
            'commentForm' => $commentForm->createView()
        ]);
    }

    //create and edit one trick
    #[Route('/newTrick', name: 'newTrick')]
    #[Route('/edit/{slug}', name: 'editTrick')]
    public function formTrick(Trick $trick = null, Request $request, EntityManagerInterface $manager, Media $media = null): Response
    {
        if(!$trick){
            $trick = new Trick();
        }
        $formTrick = $this->createForm(FormTrickType::class, $trick);
        $formTrick->handleRequest($request);
        
        if($formTrick->isSubmitted() && $formTrick->isValid()){

            if($trick){
                $trick->setUpDating(new \DateTime()) 
                    ->setUpUser($this->getUser()); 
            }
            $trick->setCreatedAte(new \DateTime())
                ->setCreatedUser($this->getUser());
              

            $name = $trick->getName();
            $slugger = new AsciiSlugger();
            $slug = $slugger->slug($name);
            $trick->setSlug($slug);                

            
            $manager->persist($trick);
            $manager->flush();

            return $this->redirectToRoute('trick', ['slug' => $trick->getSlug()]);

        }

        return $this->render('trick/createEditTrick.html.twig', ['formTrick' => $formTrick->createView(), 
        'editMode' => $trick->getId() !== null,
        ]);
    }

        //delect one trick

        #[Route('/delete/trick/{slug}', name: 'deleteTrick')]
        public function deleteTrick(Trick $trick, EntityManagerInterface $manager): Response
        {
            $manager->remove($trick);
            $manager->flush();
            $this->addFlash("flash", "Figure supprimée à jamais...");
            return $this->redirectToRoute('home');
        }
}
