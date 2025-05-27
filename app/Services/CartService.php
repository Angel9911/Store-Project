<?php

namespace App\Services;

interface CartService
{
    public function addProductInCart(string $productName,string $productId,int $quantity,float $price): void;
    public function removeProductFromCart(string $productId): void;
    public function getAllProductsFromCart(): array;
    public function clearCart(): void;
    public function calculateTotalPrice(): float;
}
