<?php

namespace App\Services\Impl;

use App\Models\Order;
use App\Repositories\OrderRepository;
use App\Services\OrderService;

class OrderServiceImpl implements OrderService
{

    private OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function createOrder(array $orderData, array $products): Order
    {
        return $this->orderRepository->createOrder($orderData, $products);
    }

    public function getOrdersByUser(int $userId): array
    {
        // TODO: Implement getOrdersByUser() method.
    }

    public function getOrderDetailsByUser(int $userId, int $orderId): array
    {
        // TODO: Implement getOrderDetailsByUser() method.
    }
}
