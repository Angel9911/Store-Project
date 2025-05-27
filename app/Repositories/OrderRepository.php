<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository
{
    public function createOrder(array $orderData, array $products): Order
    {
        $order = Order::create($orderData);

        foreach ($products as $product) {
            $order->orderProducts()->create([
                'product_id' => $product['id'],
                'quantity' => $product['quantity'],
                'price' => $product['price'],
                'subtotal' => $product['quantity'] * $product['price'],
            ]);
        }

        return $order;
    }
}
