<?php

namespace App\Controller;

use App\Entity\User2;
use App\Form\User2Type;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;


class UserController extends AbstractController
{
    #[Route('/appuser', name: 'app_user')]
    public function index(): Response
    {
        $user = $this->getDoctrine()->getManager()->getRepository(User2::class)->findAll();
        return $this->render('user/index.html.twig', ['b'=>$user ]);
    }
    #[Route('/adduser', name: 'add_user')]
    public function adduser(Request $request): Response
    {
        $user = new User2();

        $form = $this->createForm(User2Type::class,$user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('app_template');
        }
        return $this->render('user/adduser.html.twig',['f'=>$form->createView()]);
    }
    

   
    
    #[Route('/{userid}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, User2Repository $User2Repository): Response
    {
        $form = $this->createForm(user::class, $membre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $User2Repository->save($user, true);

            return $this->redirectToRoute('app_user', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/updateuser.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }
}
