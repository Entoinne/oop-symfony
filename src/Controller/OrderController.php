<?php

namespace App\Controller;

use App\Repository\OrderRepository;
use App\UseCase\CreateOrder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class OrderController extends AbstractController
{


    public function __construct(private CreateOrder $useCreateOrder)
    {
        $this->useCreateOrder = $useCreateOrder;
    }

    #[Route('/orders', name: 'get_order', methods: ['GET'])]
    public function getAllOrders(
        OrderRepository $orderRepository
    ): JsonResponse {
        $orders = $orderRepository->findAll();
        return $this->json([
            'message' => $orders,
        ]);
    }

    #[Route('/orders', name: 'create_order', methods: ['POST'])]
    public function CreateOrder(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $order = $this->useCreateOrder->createOrder($data);
        return $this->json([
            'message' => serialize($order),
        ]);
    }
}
