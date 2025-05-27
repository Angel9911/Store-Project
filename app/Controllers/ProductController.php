<?php

namespace App\Controllers;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Services\Impl\ProductServiceImpl;
use App\Services\ProductService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use \Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    private ProductServiceImpl $productService;

    private CategoryService $categoryService;

    public function __construct(ProductService $productService
                                , CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    /**
     * List all or filter by category
     * @param Request $request
     * @return Factory|Application|View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
     */
    public function showProducts(Request $request): Factory|Application|View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $categoryId = $request->input('category_id');

        $products = $categoryId
            ? $this->productService->getProductByCategory($categoryId)
            : $this->productService->getProducts();

        $categories = $this->categoryService->getCategories();

        return view('home.index', compact('products', 'categories'));
    }

    // Public: Show single product details
    public function showProductDetails($id): Factory|Application|View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $product = $this->productService->getProduct($id);
        return view('products.details_show', compact('product'));
    }

    // Admin: Show form to create product
    public function showCreateProductForm(): Factory|Application|View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $categories = $this->categoryService->getCategories();
        $brands = $this->productService->getBrands();

        return view('products.create', compact('categories', 'brands'));
    }

    // Admin: Store new product
    public function createProduct(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
        ]);

        $this->productService->createProduct($validated);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    // Admin: Edit product form
    public function showEditProductForm($id)
    {
        $product = $this->productService->getProduct($id);
        $categories = $this->categoryService->getCategories();
        $brands = $this->productService->getBrands();

        return view('products.edit', compact('product', 'categories', 'brands'));
    }

    // Admin: Update product
    public function editProductForm(Request $request, $id): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
        ]);

        $editedProduct = $this->productService->getProduct($id);

        $this->productService->editProduct($editedProduct, $validated);

        return redirect()->route('products.index')->with('success', 'Product updated.');
    }

    // Admin: Delete product
    public function deleteProduct($id): \Illuminate\Http\RedirectResponse
    {
        $this->productService->removeProduct($id);
        return redirect()->route('products.index')->with('success', 'Product deleted.');
    }
}
