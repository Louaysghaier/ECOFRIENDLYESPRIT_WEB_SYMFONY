<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EventRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Event;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\EventType;
use App\Form\TimeType;
use App\Form\SearchByNameType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;










class EventController extends AbstractController
{
    #[Route('/event', name: 'app_event')]
    public function index(): Response
    {
        return $this->render('event/index.html.twig', [
            'controller_name' => 'EventController',
        ]);
    }

    #[Route('/affichevent', name: 'affichevent')]
    public function affiche(EventRepository $repo): Response
    {
        $events = $repo->findAll();
        return $this->render('event/afficheevent.html.twig', [
            'events' => $events,
        ]);
    }
    





    #[Route('/afficheventtt', name: 'afficheventtt')]
    public function affichecard(EventRepository $repo): Response
    {
        $events = $repo->findAll();
        return $this->render('event/affichecard.html.twig', [
            'events' => $events,
        ]);
    }





    #[Route('/supprimevent/{i}', name: 'supprimevent')]
    public function DeleteEvent($i,EventRepository $repo,ManagerRegistry  $doctrine): Response
    {

         //recuperer l auteur a supprimer
         $event=$repo->find($i);
          //recuperer le entity manager;le chef d orchestre de Orm
         $em=$doctrine->getManager();
         //action suppression
         $em->remove($event);
         //commit
         $em->flush();
        return $this->redirectToRoute('affichevent');
    }
    
   

#[Route('/editevent/{i}', name: 'editevent')]
    public function editevent($i,ManagerRegistry $doctrine , EventRepository $repo,Request $req): Response
    {

        $event=$repo->find($i);
        // Créez un formulaire pour l'édition de l'étudiant en utilisant StudentformType
        $form = $this->createForm(EventType::class, $event);

        // Traitez la soumission du formulaire
        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            // Vous n'avez pas besoin d'appeler persist() car $student est déjà géré par Doctrine
            $em = $doctrine->getManager();
            $em->flush();

            // Redirigez l'utilisateur vers la page d'affichage des étudiants
            return $this->redirectToRoute('affichevent');
        }

        return $this->render('event/editevent.html.twig', [
            'form' => $form->createView(),
            'event' => $event, // Vous pouvez passer l'étudiant pour afficher des informations existantes dans le formulaire
        ]);
    }


    #[Route('/searchbyname', name: 'searchbyname')]
    public function searchEvent(EventRepository $repo, Request $request): Response
    {
        $form = $this->createForm(SearchByNameType::class);
        $form->handleRequest($request);
        $event = null;
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérez la valeur du champ de recherche
            $eventName = $form->get('nomevent')->getData();
    
            // Utilisez la valeur pour effectuer votre recherche (insensible à la casse)
            $event = $repo->findBy(['nomevent' => $eventName], ['nomevent' => 'ASC'], null, null, ['nomevent' => 'NOCASE']);
    
            // Faites quelque chose avec les résultats
            if ($event) {
                // Par exemple, affichez les détails de l'événement
                return $this->render('event/searchbyname.html.twig', [
                    'form' => $form->createView(),
                    'event' => $event,
                ]);
            }
        }
    
        return $this->render('event/searchbyname.html.twig', [
            'form' => $form->createView(),
            'event' => $event, 
        ]);
    }
    



   // #[Route('/addEvent', name: 'addEvent')]
    //public function ajoutA(ManagerRegistry $doctrine , Request $req): Response
    //{ 
    
//instancier
//$event=new Event();
//creer l objet forme
//$form=$this->createForm(StudentformType::class,$student);

//récuperer les donnees saisies dans form 
//$form->handleRequest($req);
//if($form->isSubmitted()){
   // $em = $doctrine->getManager();
   // $em->persist($student);
   // $em->flush();
   // return $this->redirectToRoute('affichestu');}
   // return $this->render('studentss/addstu.html.twig', [
     //   'form' => $form->createView(),
    //]);
//}



    #[Route('/addEvent', name: 'addEvent')]
    public function ajoutA(ManagerRegistry $doctrine, Request $req): Response
    {
        // Instancier
        $event = new Event();
    
        // Créer l'objet formulaire
        $form = $this->createForm(EventType::class, $event);
    
        // Assigner l'utilisateur actuel (remplacez 1 par la valeur appropriée)
        $event->setIduser(1);
    
        // Récupérer les données saisies dans le formulaire
        $form->handleRequest($req);
    
        // Gérer l'upload d'image
        if ($form->isSubmitted() && $form->isValid()) {
            
            $event->setDateCreation(new \DateTime());
    
            $em = $doctrine->getManager();
            $em->persist($event);
            $em->flush();
    
            return $this->redirectToRoute('affichevent');
        }
    
        return $this->render('event/addEvent.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
 //   private function handleImageUpload($file, $event)
   // {
        // Générez un nom de fichier unique
     //   $newFilename = uniqid().'.'.$file->guessExtension();

       // try {
            // Déplacez le fichier vers le répertoire où vous souhaitez stocker les images
         //   $file->move($this->getParameter('kernel.project_dir').'/public/uploads', $newFilename);

            // Mettez à jour l'entité Event avec le chemin de l'image
           // $event->setImage('uploads/'.$newFilename);
      //  } catch (FileException $e) {
            // Gérez les exceptions liées au téléchargement de fichier ici
        //}
   // }



 
    #[Route('/showDetails/{i}', name: 'showDetails')]
     
    public function showDetails($i,EventRepository $repo)
    {
        // Récupérer l'événement depuis le référentiel
        $event=$repo->find($i);

        // Vérifier si l'événement existe
        if (!$event) {
            throw $this->createNotFoundException('Event not found');
        }

        // Passer les données nécessaires à votre vue
        return $this->render('event\showdetails.html.twig', [
            'event' => $event,
        ]);
    }







}
