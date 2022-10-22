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
use App\Form\FormPhotoType;
use App\Form\FormVideoType;
use App\Form\FormCommentType;

class MediaController extends AbstractController
{

    //create one video
    #[Route('/trick/{slug}/video', name: 'addVideo')]
    public function formVideo(Trick $trick, Request $request, EntityManagerInterface $manager, Media $video = null): Response
    {
        $video = new Media();
        $formVideo = $this->createForm(FormVideoType::class, $video);

        $formVideo->handleRequest($request); 
            
        if($formVideo->isSubmitted() && $formVideo->isValid()) {

            $url = $video->getVideo();
            parse_str( parse_url( $url, PHP_URL_QUERY ), $urlId );            
            $video->setUrl($urlId['v']);
            $video->setCreatedAte(new \DateTime());
            $video->setTrickRelation($trick);
            $video->setUpdatedAt(new \DateTime());
            $video->setImageName(0);
            $video->setType(2);
                
            $manager->persist($video);
            $manager->flush();
                        
            return $this->redirectToRoute('trick', ['slug' => $trick->getSlug()]);
        }
        return $this->render('trick/createVideo.html.twig', ['formVideo' => $formVideo->createView(),
        'slug' => $trick->getSlug()]);
    }

        //create one photo
        #[Route('/trick/{slug}/photo', name: 'addPhoto')]
        public function formPhoto(Trick $trick, Request $request, EntityManagerInterface $manager, Media $photo = null): Response
        {
            
            $photo = new Media();
            $formPhoto = $this->createForm(FormPhotoType::class, $photo);
    
            $formPhoto->handleRequest($request); 
                
            if($formPhoto->isSubmitted() && $formPhoto->isValid()) {
                $photo->setCreatedAte(new \DateTime());
                $photo->setTrickRelation($trick);
                $photo->setUpdatedAt(new \DateTime());
                $photo->setUrl(0);
                $photo->setType(1);
                
                $manager->persist($photo);
                $manager->flush();
                            
                return $this->redirectToRoute('trick', ['slug' => $trick->getSlug()]);
            }
            return $this->render('trick/createPhoto.html.twig', ['formPhoto' => $formPhoto->createView(),
            'slug' => $trick->getSlug()]);
        }

        //delect one media

        #[Route('/trick/{slug}/deleteMedia', name: 'deleteMedia')]
        public function deleteMedia(Media $media, EntityManagerInterface $manager): Response
        {
            $manager->remove($media);
            $manager->flush();
            return $this->redirectToRoute('trick');
        }
}