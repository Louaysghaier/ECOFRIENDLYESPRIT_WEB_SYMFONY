<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\User;
use App\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class PostController extends AbstractController
{
    #[Route('/post', name: 'app_post')]
    public function index(): Response
    {
        return $this->render('post/index.html.twig', [
            'controller_name' => 'PostController',
        ]);
    }

    #[Route('/addPost', name: 'addPost')]
    public function addPost(ManagerRegistry $manager, Request $request): Response
    {
        $em = $manager->getManager();
        $user = $this->getUser();
        $post = new Post();
    
        $form = $this->createForm(PostType::class,$post,[
            'user' => $user,
        ]);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $post->prePersist();
            //$post = $form->getData();
            $post->setIduser($user);

            $em->persist($post);  //add
            $em->flush();

            return $this->redirectToRoute('app_post');
        }
        return $this->render("post/addPost.html.twig",[
         'form'=>$form->createView()
         ]);

        
    }
}
