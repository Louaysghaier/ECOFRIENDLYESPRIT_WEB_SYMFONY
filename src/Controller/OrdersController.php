<?php

namespace App\Controller;

use App\Entity\Orders;
use App\Entity\Service;
use App\Entity\User2;
use App\Form\Orders1Type;
use App\Repository\OrdersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\CurrentUserService;

#[Route('/orders')]
class OrdersController extends AbstractController
{
    #[Route('/pannier', name: 'app_orders_index', methods: ['GET'])]
    public function index(OrdersRepository $ordersRepository): Response
    {
        return $this->render('orders/index.html.twig', [
            'orders' => $ordersRepository->findAll(),
        ]);
    }

  /*  #[Route('/shop', name: 'app_orders_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Fetch services from the database
        $services = $this->getDoctrine()->getRepository(Service::class)->findAll();

        return $this->render('service/ServicesShop.html.twig', [
            'services' => $services,
        ]);
    }*/

    #[Route('/{orderid}', name: 'app_orders_show', methods: ['GET'])]
    public function show(Orders $order): Response
    {
        return $this->render('orders/show.html.twig', [
            'order' => $order,
        ]);
    }

    #[Route('/{orderid}/edit', name: 'app_orders_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Orders $order, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Orders1Type::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_orders_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('orders/edit.html.twig', [
            'order' => $order,
            'form' => $form,
        ]);
    }

    #[Route('/{orderid}', name: 'app_orders_delete', methods: ['POST'])]
    public function delete(Request $request, Orders $order, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$order->getOrderid(), $request->request->get('_token'))) {
            $entityManager->remove($order);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_orders_index', [], Response::HTTP_SEE_OTHER);
    }
    private $currentUserService;

    public function __construct(CurrentUserService $currentUserService)
    {
        $this->currentUserService = $currentUserService;
    }

     #[Route("/{add-to-order}", name:'add_to_order', methods: ['POST'])]

    public function addToOrder(Request $request): Response
    {
        $serviceId = $request->request->get('serviceId');

        // Fetch the Service entity from the database using $serviceId
        $service = $this->getDoctrine()->getRepository(Service::class)->find($serviceId);

        if (!$service) {
            return new JsonResponse(['success' => false, 'message' => 'Service not found.']);
        }
        // Get the current user from the CurrentUserService
        $user = $this->currentUserService->getCurrentUser();

        if (!$user instanceof User2) {
            return new JsonResponse(['success' => false, 'message' => 'User not found.']);
        }
        // Create a new Order entity
        $order = new Orders();
        $order->setUserid($user);
        $order->addServiceid($service); // Associate the service with the order
        // Persist and flush the entities
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($order);
        try {
            $entityManager->flush();
            // If we reach this point, the order was successfully created
            return new JsonResponse(['success' => true, 'message' => 'Service added to order.']);
        } catch (\Exception $e) {
            // Handle exceptions, log them, or return an error response
            return new JsonResponse(['success' => false, 'message' => 'Failed to create order.']);
        }
    }
}
