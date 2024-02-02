<?php

namespace App\Service\Order;

use App\Entity\Order;
use App\Repository\OrderRepository;

class OrderManager
{
    public function __construct(
        private readonly OrderRepository $orderRepository,
    )
    {
    }

    public function getById(int $orderId): Order
    {
        return $this->orderRepository->find($orderId);
    }

    public function getByExternalId(string $externalId): Order
    {
        return $this->orderRepository->findBy(['externalId' => $externalId]);
    }
}