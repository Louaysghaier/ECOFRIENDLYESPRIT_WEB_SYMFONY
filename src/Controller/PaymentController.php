<?php

namespace App\Controller;

use App\Entity\Ticket;
use App\Form\PaymentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaymentController extends AbstractController
{
    #[Route('/payment/{ticketId}', name: 'payment')]
    public function processPayment(Ticket $ticket, Request $request): Response
    {
        $paymentForm = $this->createForm(PaymentType::class);
        $paymentForm->handleRequest($request);

        if ($paymentForm->isSubmitted() && $paymentForm->isValid()) {
            // Logique de traitement du paiement
            // Vous pouvez utiliser un service de paiement externe, enregistrer le paiement dans la base de données, etc.
            // ...
        }

        return $this->render('payment/process_payment.html.twig', [
            'ticket' => $ticket,
            'paymentForm' => $paymentForm->createView(),
        ]);
    }
}