<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    #[Route('/comment', name: 'app_comment')]
    public function index(): Response
    {
        return $this->render('comment/index.html.twig', [
            'controller_name' => 'CommentController',
        ]);
    }

    #[Route('/addComment', name: 'addComment')]
    public function addPost(ManagerRegistry $manager, Request $request): Response
    {
        $em = $manager->getManager();
        $user = $this->getUser();
        $comment = new Comment();
    
        $form = $this->createForm(CommentType::class,$comment,[
            'user' => $user,
        ]);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $comment->prePersist();
            //$post = $form->getData();
            $comment->setIduser($user);

            $em->persist($comment);  //add
            $em->flush();

            return $this->redirectToRoute('app_comment');
        }
        return $this->render("comment/addComment.html.twig",[
         'form'=>$form->createView()
         ]);

        
    }
}
