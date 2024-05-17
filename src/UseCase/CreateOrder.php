<?php

namespace App\UseCase;

use App\Entity\Order;
use App\Entity\OrderItem;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CreateOrder
{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    function createOrder(array $data): Order
    {
        try {
            $order = new Order();
            $order->setCreatedAt(new \DateTime());
            $order->setUpdatedAt(new \DateTime());
            $order->setCustomer('test');
            $order->setStatus('pending');
            $order->setTotal(count($data['items']) * 10);
            foreach ($data['items'] as $item) {
                if (in_array($item, array($order->getItems())) === false) {
                    $orderItem = new OrderItem();
                    $orderItem->setRelatedOrder($order);
                    $orderItem->setProduct($item);
                    $order->addItem($orderItem);
                } else {
                    $orderItem->setQuantity($orderItem->getQuantity() + 1);
                }
            }
            $this->em->persist($order);
            $this->em->flush();
            return $order;
        } catch (\Exception $e) {
            error_log($e->getMessage());
            throw $e;
        }
    }
}