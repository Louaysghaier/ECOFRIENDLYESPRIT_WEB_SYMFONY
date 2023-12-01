<?php

namespace App\Controller;
use App\Entity\Codepromo;
use App\Form\CodepromoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

class CodePromoController extends AbstractController
{

    public function __construct()
    {
        // Constructeur vide
    }
    
    #[Route('/codepromo', name: 'app_code_promo')]
    public function index(): Response
    {
        $promo = $this->getDoctrine()->getManager()->getRepository(Codepromo::class)->findAll();
        return $this->render('code_promo/index.html.twig', ['b'=>$promo ]);
       
    }
    #[Route('/addpromo', name: 'add_promo')]
    public function adduser(Request $request): Response
    {
        $promo = new codePromo();

        $form = $this->createForm(CodepromoType::class,$promo);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($promo);
            $em->flush();

            return $this->redirectToRoute('app_code_promo');
        }
        return $this->render('code_promo/codepromo.html.twig',['f'=>$form->createView()]);
    }
    #[Route('/supppromo/{idcodepromo}', name: 'sup_promo')]
    public function suppressionBlog(Codepromo $promo): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($promo);
        $em->flush();

        return $this->redirectToRoute('app_code_promo');


    }
}
