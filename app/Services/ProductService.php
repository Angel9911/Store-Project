<?php

namespace App\Services;

use App\Models\Brand;
use App\Models\Product;

interface ProductService
{
    public function getProducts(int $perPage);
    public function getBrands();
    public function createBrand(array $brandData): Brand;
    public function getProduct(int $productId);
    public function getProductByCategory(int $categoryId);
    public function createProduct(array $data);
    public function editProduct(Product $product, array $data);
    public function removeProduct(Product $product);
}
