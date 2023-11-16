<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Documents;
use App\Entity\User;
use App\Entity\Topic;
use App\Form\DocumentsType;
use App\Form\modifierdocuments;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;






class DocumentsController extends AbstractController
{
    #[Route('/documents', name: 'display_blog')]
    public function index(): Response
    {
        $documents = $this->getDoctrine()->getManager()->getRepository(Documents::class)->findAll();
        return $this->render('documents/index.html.twig', [
           'd'=>$documents
        ]);
    }
    

    #[Route('/adddocuments', name: 'app_adddocuments')]
    public function adddocuments(Request $request): Response
    {   

        $documents = new Documents();
        
        $entityManager = $this->getDoctrine()->getManager();
        $topic = $entityManager->getRepository(Topic::class)->find(11);

        // Vérifier si le sujet existe
        if (!$topic) {
            throw $this->createNotFoundException('Le sujet avec l\'ID 11 n\'existe pas.');
        }

        // Associer le sujet à l'entité Documents
        $documents->setIdtopic($topic);

        $user = $entityManager->getRepository(User::class)->find(1);
        
        if (!$user) {
            throw $this->createNotFoundException('Le sujet avec l\'ID 11 n\'existe pas.');
        }
        $documents->setIduser($user);
        $form = $this->createForm(DocumentsType::class, $documents);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
      


            $em = $this->getDoctrine()->getManager();
            $em->persist($documents);
            $em->flush();
            
            return $this->redirectToRoute('AfficheDoc');
        }

        return $this->render('documents/createDocuments.html.twig', ['f' => $form->createView()]);
    }


    #[Route("/removedoc/{iddoc}", name: 'removedoc', methods: ['GET'])]
    public function suppressiondocuments(Documents $documents): Response
    {
       
        $em = $this->getDoctrine()->getManager();
        $em->remove($documents);
        $em->flush();
        return $this->redirectToRoute('AfficheDocback');


    }
    #[Route('/modifdocuments/{iddoc}', name: 'modifdocuments')]
    public function modifdocuments(ManagerRegistry $manager, Request $request, $iddoc): Response
    {
        $em=$manager->getManager();
        $documents = $this->getDoctrine()->getManager()->getRepository(Documents::class)->find($iddoc);
    
        $form = $this->createForm(modifierdocuments::class, $documents);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            //$em = $this->getDoctrine()->getManager();
            //$em->persist($documents);
            $em->flush();
    
            return $this->redirectToRoute('display_blog');
        }
    
        return $this->render('documents/updateDocument.html.twig', ['f' => $form->createView()]);
    }
    #[Route('/AfficheDoc', name: 'AfficheDoc')]
    public function AfficheDoc(): Response
    {
        $documents =$this->getDoctrine()->getManager()->getRepository(Documents::class)->findAll();
        return $this->render('documents/index.html.twig', [
            'd'=>$documents
        ]);
    }

    #[Route('/AfficheDocback', name: 'AfficheDocback')]
    public function AfficheDocback(): Response
    {
        $documents =$this->getDoctrine()->getManager()->getRepository(Documents::class)->findAll();
        return $this->render('documents/AfficheDoc.html.twig', [
            'd'=>$documents
        ]);
    }
    

}
   



