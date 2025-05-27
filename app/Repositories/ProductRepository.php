<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function find($id)
    {
        return Product::with(['category', 'brand'])->findOrFail($id);
    }

    public function findAllProducts(int $perPage)
    {
        return Product::with(['category', 'brand'])->paginate($perPage);
    }
    public function findByCategoryId(int $categoryId, int $perPage = 12): \LaravelIdea\Helper\App\Models\_IH_Product_C|\Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Pagination\LengthAwarePaginator|array
    {
        return Product::with(['category', 'brand'])
            ->where('category_id', $categoryId)
            ->paginate($perPage);
    }

    public function create(array $data): Product
    {
        return Product::create($data);
    }

    public function update(Product $product, array $data): Product
    {
        $product->update($data);
        return $product;
    }

    public function delete(Product $product): void
    {
        $product->delete();
    }

}
