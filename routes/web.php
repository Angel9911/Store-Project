<?php

use App\Controllers\AdminController;
use App\Controllers\CartController;
use App\Controllers\HomeController;
use App\Controllers\OrderController;
use App\Controllers\ProductController;
use App\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

// Home
Route::get('/', [ProductController::class, 'showProducts'])->name('home.index');

// Cart
Route::prefix('cart')->name('cart.')->group(function () {
    // Show all cart items
    Route::get('/', [CartController::class, 'showAllProductsFromCart'])->name('cart_show');

    // Add product to cart
    Route::post('/add', [CartController::class, 'addProductToCart'])->name('add');

    // Remove single product from cart
    Route::delete('/remove/{productId}', [CartController::class, 'removeProductFromCart'])->name('remove');

    // Clear all cart items
    Route::post('/clear', [CartController::class, 'clearAllCart'])->name('clear');
});

// Order
Route::prefix('orders')->name('orders.')->middleware('auth')->group(function () {
    // Step 1: Create/submit the order
    Route::post('/create', [OrderController::class, 'createOrder'])->name('create');

    // Step 2: Success page after placing order
    Route::get('/success/{orderId}', [OrderController::class, 'success'])->name('order_success');

    // Step 3: View all orders by the logged-in user
    Route::get('/', [OrderController::class, 'showAllOrders'])->name('orders_show');

    // Step 4: View specific order details
    Route::get('/{orderId}', [OrderController::class, 'showOrderDetails'])->name('show');
});

// Products
Route::prefix('products')->name('products.')->group(function () {
    // Public: List products (all or filtered by category)
    Route::get('/', [ProductController::class, 'showProducts'])->name('index');

    // Public: Product details
    Route::get('/{id}', [ProductController::class, 'showProductDetails'])->name('details_show');
});

Route::middleware('restrict.admin')->prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login.submit');
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/categories', [AdminController::class, 'createCategory'])->name('admin.categories.create');
    Route::post('/brands', [AdminController::class, 'createBrand'])->name('admin.brands.create');
    Route::get('/categories/list', [AdminController::class, 'getCategoryList'])->name('admin.categories.list');
    Route::get('/brands/list', [AdminController::class, 'getBrandList'])->name('admin.brands.list');
});

// Authentication
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login']);

Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [UserController::class, 'register']);

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/checkout', [OrderController::class, 'showCheckoutForm'])->name('checkout.form');
