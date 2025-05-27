<?php

namespace App\Services;

use App\Models\Order;

interface OrderService
{
    public function getOrdersByUser(int $userId);

    public function getOrderDetailsByUser(int $userId, int $orderId): Order;

    public function createOrder(array $orderData, array $products): Order;
}
