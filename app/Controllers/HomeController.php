<?php

namespace App\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(protected ProductService $productService) {}

    // It's unused because the product are loaded by ProductController
/*    public function index(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $products = $this->productService->getProducts();

        return view('home.index', compact('products'));
    }*/
}
