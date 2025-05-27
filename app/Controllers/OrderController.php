<?php

namespace App\Controllers;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use App\Services\OrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class OrderController extends Controller
{
    private OrderService $orderService;

    private CartService $cartService;

    public function __construct(OrderService $orderService
                                , CartService $cartService)
    {
        $this->orderService = $orderService;
        $this->cartService  = $cartService;
    }

    // Step 2: Submit order

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function createOrder(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validatedOrderDetails = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
        ]);

        // Retrieve cart from session
        $cartItems = session()->get('cart', []);

        if (empty($cartItems)) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        // Prepare product data and calculate total price
        $productData = [];
        $totalPrice = 0;

        foreach ($cartItems as $item) {
            $productData[] = [
                'id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ];
            $totalPrice += $item['price'] * $item['quantity'];
        }

        // Add totalPrice to the validated order details
        $validatedOrderDetails['totalPrice'] = $totalPrice;

        $validatedOrderDetails['user_id'] = Auth::id();

        $order = $this->orderService->createOrder($validatedOrderDetails,$productData);

        $this->cartService->clearCart();

        return redirect()->route('orders.order_success', $order->id);
    }

    /**
     * @return View|RedirectResponse
     */
    public function showCheckoutForm(): View|RedirectResponse
    {
        $cartItems = $this->cartService->getAllProductsFromCart();
        $total = $this->cartService->calculateTotalPrice();

        if (empty($cartItems)) {
            return redirect()->route('cart.cart_show')->with('error', 'Your cart is empty.');
        }

        return view('orders.checkout', compact('cartItems', 'total'));
    }

    // Step 3: Success page
    public function success($orderId): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('orders.order_success', compact('orderId'));
    }

    // View list of orders by the logged-in user
    public function showAllOrders(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $orders = $this->orderService->getOrdersByUser(Auth::id());

        return view('orders.orders_show', compact('orders'));
    }

    // Optional: View details of a specific order
    public function showOrderDetails($orderId): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {   
        $order = $this->orderService->getOrderDetailsByUser(Auth::id(), $orderId);

        return view('orders.orders_show_details', compact('order'));
    }
}
