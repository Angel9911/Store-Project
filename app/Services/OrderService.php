<?php

namespace App\Services;

use App\Models\Order;

interface OrderService
{
    public function getOrdersByUser(int $userId): array;

    public function getOrderDetailsByUser(int $userId, int $orderId): array;

    public function createOrder(array $orderData, array $products): Order;
}
