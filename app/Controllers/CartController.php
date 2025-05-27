<?php

namespace App\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\CartService;
use App\Services\ProductService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private CartService $cartService;

    public function __construct(CartService $cartService) {

        $this->cartService = $cartService;
    }

    /**
     * Display all products in the cart.
     * @return Factory|Application|View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
     */
    public function showAllProductsFromCart(): Factory|Application|View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $cartItems = $this->cartService->getAllProductsFromCart();
        $total = $this->cartService->calculateTotalPrice();

        return view('cart.cart_show', compact('cartItems', 'total'));
    }

    /**
     * Add product to cart.
     * @param Request $request
     * @return RedirectResponse
     */
    public function addProductToCart(Request $request): RedirectResponse
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        $quantity = $request->input('quantity', 1);

        $this->cartService->addProductInCart($product->name,$product->id, $quantity, $product->price);

        return redirect()->back()->with('success', 'Product added to cart.');
    }

    /**
     * Remove product from cart.
     * @param $productId
     * @return RedirectResponse
     */
    public function removeProductFromCart($productId): RedirectResponse
    {
        $this->cartService->removeProductFromCart($productId);

        return redirect()->back()->with('success', 'Product removed from cart.');
    }

    /**
     * Clear the cart completely.
     */
    public function clearAllCart()
    {
        $this->cartService->clearCart();

        return redirect()->route('cart.index')->with('success', 'Cart cleared.');
    }
}
