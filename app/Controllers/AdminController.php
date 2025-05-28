<?php

namespace App\Controllers;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private CategoryService $categoryService;

    private ProductService $productService;

    /**
     * @param CategoryService $categoryService
     * @param ProductService $productService
     */
    public function __construct(CategoryService $categoryService, ProductService $productService)
    {
        $this->categoryService = $categoryService;
        $this->productService = $productService;
    }


    public function showLogin(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.login');
    }

    public function login(Request $request): \Illuminate\Http\RedirectResponse
    {
        // Dummy login since access is IP restricted
        session(['is_admin' => true]);
        return redirect()->route('admin.dashboard');
    }

    public function dashboard(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        if (!session('is_admin')) {
            return redirect()->route('admin.login');
        }

        return view('admin.admin_dashboard');
    }

    public function getCategoryList(): \Illuminate\Http\JsonResponse
    {
        $categories = $this->categoryService->getCategories();
        return response()->json($categories);
    }

    public function getBrandList(): \Illuminate\Http\JsonResponse
    {
        $brands = $this->productService->getBrands();
        return response()->json($brands);
    }

    public function createCategory(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = $this->categoryService->createCategory($validated);

        return back()->with('success', 'Category created successfully!');
    }

    public function createBrand(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $brand = $this->productService->createBrand($validated);

        return back()->with('success', 'Brand created successfully!');
    }
}
