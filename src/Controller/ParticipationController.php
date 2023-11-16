<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ParticipationRepository;
use Doctrine\Persistence\ManagerRegistry;

class ParticipationController extends AbstractController
{
    #[Route('/participation', name: 'app_participation')]
    public function index(): Response
    {
        return $this->render('participation/index.html.twig', [
            'controller_name' => 'ParticipationController',
        ]);
    }

    #[Route('/afficheparticipation', name: 'afficheparticipation')]
    public function afficheparticipation(ParticipationRepository $repo): Response
    {
        $participation = $repo->findAll();
        return $this->render('participation/afficheparticipation.html.twig', [
            'participation' => $participation,
        ]);
    }


    #[Route('/supprimeparticipation/{i}', name: 'supprimeparticipation')]
    public function Supprimeparticipation($i,ParticipationRepository $repo,ManagerRegistry  $doctrine): Response
    {

         //recuperer l auteur a supprimer
         $participation=$repo->find($i);
          //recuperer le entity manager;le chef d orchestre de Orm
         $em=$doctrine->getManager();
         //action suppression
         $em->remove($participation);
         //commit
         $em->flush();
        return $this->redirectToRoute('afficheparticipation');
    }
    



}
