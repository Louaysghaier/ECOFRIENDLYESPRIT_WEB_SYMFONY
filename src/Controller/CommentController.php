<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\User;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class CommentController extends AbstractController
{
    #[Route('/comment', name: 'app_comment')]
    public function index(): Response
    {
        return $this->render('comment/index.html.twig', [
            'controller_name' => 'CommentController',
        ]);
    }

    #[Route('/addComment/{postId}', name: 'addComment')]
    public function addComment(ManagerRegistry $manager, Request $request, $postId): Response
    {
        $em = $manager->getManager();
        //$user = $this->getUser();
        $comment = new Comment();
        
        $form = $this->createForm(CommentType::class,$comment,/*[
            'user' => $user,
        ]*/);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
        
            $comment->setIdPost($postId);
            $comment->prePersist();
            //$comment->setIduser($user);

            $em->persist($comment);  //add
            $em->flush();

            return $this->redirectToRoute('SaleandExchange');
        }
        return $this->render("comment/addComment.html.twig",[
         'form'=>$form->createView()
         ]);

        
    }
    #[Route('/Readcomment', name: 'Readcomment')]
    public function ReadComment(): Response
    {
        $comments =$this->getDoctrine()->getManager()->getRepository(Comment::class)->findAll();
        return $this->render('Comment/ReadComment.html.twig', [
            'c'=>$comments
        ]);
    }
    #[Route('/Readcommentfront/{postId}', name: 'Readcommentfront')]
    public function readCommentsfront($postId): Response
    {
        $commentRepository = $this->getDoctrine()->getRepository(Comment::class);
        $comments = $commentRepository->findBy(['idPost' => $postId]);

        return $this->render('comment/ReadCommentFront.html.twig', [
            'c' => $comments,
        ]);
    }
    /*public function ReadCommentfront($postId, CommentRepository $commentRepository): Response
    {
        $comments =$this->getDoctrine()->getManager()->getRepository(Comment::class)->find($postId);
        return $this->render('Comment/ReadCommentFront.html.twig', [
            'c'=>$comments
        ]);
    }*/

    #[Route('/Deletecomment/{id}', name: 'Deletecomment')]
public function DeleteComment(int $id): Response
{
    $entityManager = $this->getDoctrine()->getManager();
    $comment = $entityManager->getRepository(Comment::class)->find($id);

    if (!$comment) {
        throw $this->createNotFoundException('Comment not found');
    }

    $entityManager->remove($comment);
    $entityManager->flush();

    return $this->redirectToRoute('SaleandExchange');
}
    #[Route('/EditComment/{id}', name: 'EditComment')]
    public function EditPost(ManagerRegistry $manager, Request $request, $id): Response
    {
        $em = $manager->getManager();
        //$user = $this->getUser();
        $comment =$this->getDoctrine()->getManager()->getRepository(Comment::class)->find($id);
    
        $form = $this->createForm(CommentType::class,$comment,/*[
            'user' => $user,
        ]*/);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $comment->prePersist();
            //$comment->setIduser($user);

            $em->flush();

            return $this->redirectToRoute('SaleandExchange');
        }
        return $this->render("comment/updateComment.html.twig",[
         'form'=>$form->createView()
         ]);

        
    }
    
}
