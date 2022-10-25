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
       //view  comments
       #[Route('/trick/comments/{slug}', name: 'comment')]
       public function trick($slug, TrickRepository $trickRepo, Request $request, EntityManagerInterface $manager): Response
       {   
           $trick = $trickRepo->findOneBy(['slug' => $slug]);
    
           return $this->render('comment/trick.html.twig', ['trick' => $trick]);
       }
}