<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

	
use Doctrine\ORM\EntityManagerInterface; //objetmanager

use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Posts;
use App\Repository\PostsRepository;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use App\Form\FormPostType;

class PostsController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(PostsRepository $postsRepo): Response
    {
        $allposts = $postsRepo->findAll();
        return $this->render('home.html.twig', ['allposts' => $allposts,]);
    }

    #[Route('/tricks', name: 'list')]
    public function list(PostsRepository $postsRepo): Response
    {
        $allposts = $postsRepo->findAll();
        return $this->render('posts/allposts.html.twig', ['allposts' => $allposts,]);
    }


    #[Route('/tricks/{id}', name: 'post')]
    public function post($id, PostsRepository $postsRepo): Response
    {
        $post = $postsRepo->find($id);
        return $this->render('posts/post.html.twig', ['post' => $post,]);
    }

    #[Route('/newTrick', name: 'newPost')]
    #[Route('/tricks/{id}/edit', name: 'editPost')]
    public function formPost(Posts $post = null, Request $request, EntityManagerInterface $manager): Response
    {
        if(!$post){
            $post = new Posts();
        }

        $form = $this->createForm(FormPostType::class, $post);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            if(!$post->getId()){
            $post->setCreatDate(new \DateTime());                
            }
            $post->setUpDating(new \DateTime());  

            $manager->persist($post);
            $manager->flush();

            return $this->redirectToRoute('post', ['id' => $post->getId()]);

        }

        return $this->render('posts/creat.html.twig', ['formCreatPost' => $form->createView(), 'editMode' => $post->getId() !== null]);
    }
}
