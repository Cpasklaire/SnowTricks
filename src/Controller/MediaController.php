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

class MediaController extends AbstractController
{

    //create and edit one media
    #[Route('/trick/{slug}/media', name: 'addMedia')]
    public function formMedia(Trick $trick, Request $request, EntityManagerInterface $manager, Media $media = null): Response
    {
        
        $media = new Media();
        $formMedia = $this->createForm(FormMediaType::class, $media);

        $formMedia->handleRequest($request); 
            
        if($formMedia->isSubmitted() && $formMedia->isValid()){
            $media->setCreatedAte(new \DateTime())
                ->setTrickRelation($trick)
                ->setUpdatedAt(new \DateTime());           
            
        if(!$media->getImageFile()) {
            $media->setImageName(0);
        }else{
            $media->setUrl(0);
        }

        /* if($media->setMainPhoto(1)) 
        recherche toute la collection de media
        passer les autre mainphoto sur false
        Toujours avec 1 main photo si photo*/
            
            $manager->persist($media);
            $manager->flush();

            return $this->redirectToRoute('trick', ['slug' => $trick->getSlug()]);
        }


        return $this->render('trick/createEditMedia.html.twig', ['formMedia' => $formMedia->createView(),
        'slug' => $trick->getSlug()]);
    }

        //delect one trick

        #[Route('/trick/{slug}/delete', name: 'deleteTrick')]
        public function deleteTrick(Trick $trick, EntityManagerInterface $manager): Response
        {
            $manager->remove($trick);
            $manager->flush();

            return $this->redirectToRoute('home');
        }
}