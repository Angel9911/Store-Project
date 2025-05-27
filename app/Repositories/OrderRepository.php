<?php

namespace App\Repositories;

use App\Models\Order;
use Ramsey\Collection\Collection;

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

    public function getOrdersByUserId(int $userId): array|\Illuminate\Database\Eloquent\Collection|\LaravelIdea\Helper\App\Models\_IH_Order_C
    {
        return Order::with('orderProducts.product') // eager load product details
        ->where('user_id', $userId)
            ->orderByDesc('created_at')
            ->get();
    }

    public function getOrderDetailsByUserId(int $userId, int $orderId): Order
    {
        return Order::with(['orderProducts.product'])
            ->where('id', $orderId)
            ->where('user_id', $userId)
            ->first();
    }

}
