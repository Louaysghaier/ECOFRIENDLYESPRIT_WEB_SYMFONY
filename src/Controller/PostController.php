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
        //$user = $this->getUser();
        $post = new Post();
        
        $form = $this->createForm(PostType::class,$post,[
            //'user' => $user,
          
        ]);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $uploadedFile = $form->get('imagePost')->getData();
    
            if ($uploadedFile) {
                $imageDirectory = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = uniqid().'.'.$uploadedFile->guessExtension();
    
                try {
                    $destination = $this->getParameter('kernel.project_dir').'/public/uploads/images/';
                    $uploadedFile->move($destination, $newFilename);
                } catch (FileException $e) {
                    // Handle the file upload exception
                }
    
                $post->setImagePost('uploads/images/'.$newFilename);
            }
        
            $post->prePersist();
            //$post->setNbresComments(getCommentCount());
            //$post = $form->getData();
            //$post->setIduser($user);

            $em->persist($post);  //add
            $em->flush();

            return $this->redirectToRoute('SaleandExchange');
        }
        return $this->render("post/addPost.html.twig",[
         'form'=>$form->createView()
         ]);

        
    }
    #[Route('/Readpost', name: 'Readpost')]
    public function ReadPost(): Response
    {
        $posts =$this->getDoctrine()->getManager()->getRepository(Post::class)->findAll();
        return $this->render('post/ReadPost.html.twig', [
            'p'=>$posts
        ]);
    }

    /*#[Route('/Deletepost/{postId}', name: 'Deletepost')]
    public function DeleteComment($postId): Response
    {
        $em =$this->getDoctrine()->getManager();
        $em->remove($postId);
        $em->flush();

        return $this->redirectToRoute('app_comment');
    }*/
    #[Route('/deletePost/{postId}', name: 'deletePost')]
public function deletePost($postId): Response
{
    $entityManager = $this->getDoctrine()->getManager();
    $post = $entityManager->getRepository(Post::class)->find($postId);

    if (!$post) {
        throw $this->createNotFoundException('Post not found');
    }

    // Récupérer les commentaires associés au post
    $comments = $post->getComments();

    // Supprimer manuellement les commentaires associés
    foreach ($comments as $comment) {
        $entityManager->remove($comment);
    }

    // Supprimer le post
    $entityManager->remove($post);
    $entityManager->flush();

    return $this->redirectToRoute('ReadPostBack');
}

    #[Route('/updatePost/{postId}', name: 'updatePost')]
    public function updatePost(ManagerRegistry $manager, Request $request, $postId): Response
    {
        $em = $manager->getManager();
        //$user = $this->getUser();
        $post =$this->getDoctrine()->getManager()->getRepository(Post::class)->find($postId);
    
        $form = $this->createForm(PostType::class,$post,/*[
            'user' => $user,
        ]*/);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $post->prePersist();
            //$post->setIduser($user);

            $em->flush();

            return $this->redirectToRoute('ReadPostBack');
        }
        return $this->render("post/updatePost.html.twig",[
         'form'=>$form->createView()
         ]);

        
    }
    #[Route('/SaleandExchange', name: 'SaleandExchange')]
    public function SaleandExchange(): Response
    {
        $posts =$this->getDoctrine()->getManager()->getRepository(Post::class)->findBy(['Subject' => 'Sale & Exchange']);
        return $this->render('post/SaleandExchange.html.twig', [
            'p'=>$posts
        ]);
    }
    #[Route('/CodingProblems', name: 'CodingProblems')]
    public function CodingProblems(): Response
    {
        $posts =$this->getDoctrine()->getManager()->getRepository(Post::class)->findBy(['Subject' => 'Coding Problems']);
        return $this->render('post/CodingProblems.html.twig', [
            'p'=>$posts
        ]);
    }
    #[Route('/EspritProblems', name: 'EspritProblems')]
    public function EspritProblems(): Response
    {
        $posts =$this->getDoctrine()->getManager()->getRepository(Post::class)->findBy(['Subject' => 'Esprit Problems']);
        return $this->render('post/EspritProblems.html.twig', [
            'p'=>$posts
        ]);
    }
    #[Route('/ReadPostBack', name: 'ReadPostBack')]
    public function ReadPostBack(): Response
    {
        $posts =$this->getDoctrine()->getManager()->getRepository(Post::class)->findAll();
        return $this->render('post/ReadPostBack.html.twig', [
            'p'=>$posts
        ]);
    }
    
}
