<?php

namespace App\Services\Impl;

use App\Models\Product;
use App\Repositories\BrandRepository;
use App\Repositories\ProductRepository;
use App\Services\ProductService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use LaravelIdea\Helper\App\Models\_IH_Product_C;

class ProductServiceImpl implements ProductService
{

    private ProductRepository $productRepository;
    private BrandRepository $brandRepository;

    public function __construct(ProductRepository $productRepository
                                , BrandRepository $brandRepository)
    {
        $this->productRepository = $productRepository;
        $this->brandRepository = $brandRepository;
    }

    /**
     * @param int $perPage
     * @return _IH_Product_C|LengthAwarePaginator|\Illuminate\Pagination\LengthAwarePaginator|array
     */
    public function getProducts(int $perPage = 12): _IH_Product_C|LengthAwarePaginator|\Illuminate\Pagination\LengthAwarePaginator|array
    {
        return $this->productRepository->findAllProducts($perPage);
    }

    public function getProduct(int $productId): _IH_Product_C|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|\LaravelIdea\Helper\App\Models\_IH_Product_QB|\Illuminate\Database\Eloquent\Builder|Product|array|null
    {
        return $this->productRepository->find($productId);
    }

    public function createProduct(array $data)
    {
        return $this->productRepository->create($data);
    }

    public function removeProduct(Product $product): void
    {
        $this->productRepository->delete($product);
    }

    public function getProductByCategory(int $categoryId): _IH_Product_C|LengthAwarePaginator|\Illuminate\Pagination\LengthAwarePaginator|array
    {
        return $this->productRepository->findByCategoryId($categoryId);
    }

    public function getBrands(): \LaravelIdea\Helper\App\Models\_IH_Brand_C|\Illuminate\Database\Eloquent\Collection|array
    {
        return $this->brandRepository->getBrands();
    }

    public function editProduct(Product $product, array $data)
    {
        return $this->productRepository->update($product, $data);
    }
}
