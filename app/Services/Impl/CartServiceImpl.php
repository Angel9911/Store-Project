<?php

namespace App\Services\Impl;

use App\Constraints\SessionConstraints;
use App\Services\CartService;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class CartServiceImpl implements CartService
{

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getAllProductsFromCart(): array
    {
        return session()->get(SessionConstraints::$CART_SESSION_NAME, []);
    }

    /**
     * @param string $productName
     * @param string $productId
     * @param int $quantity
     * @param $price
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function addProductInCart(string $productName, string $productId, int $quantity, $price): void
    {
        $cart = $this->getAllProductsFromCart();

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'product_id' => $productId,
                'product_name' => $productName,
                'quantity' => $quantity,
                'price' => $price,
            ];
        }

        session()->put(SessionConstraints::$CART_SESSION_NAME, $cart);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function removeProductFromCart($productId): void
    {
        $cart = $this->getAllProductsFromCart();

        unset($cart[$productId]);

        session()->put(SessionConstraints::$CART_SESSION_NAME, $cart);
    }

    public function clearCart(): void
    {
        session()->forget(SessionConstraints::$CART_SESSION_NAME);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function calculateTotalPrice(): float
    {
        return collect($this->getAllProductsFromCart())
            ->reduce(fn($sum, $item) => $sum + ($item['price'] * $item['quantity']), 0);
    }
}
