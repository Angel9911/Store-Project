<?php

namespace App\Providers;

use App\Repositories\BrandRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;
use App\Services\CartService;
use App\Services\CategoryService;
use App\Services\Impl\CartServiceImpl;
use App\Services\Impl\CategoryServiceImpl;
use App\Services\Impl\OrderServiceImpl;
use App\Services\Impl\ProductServiceImpl;
use App\Services\Impl\UserServiceImpl;
use App\Services\OrderService;
use App\Services\ProductService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProductRepository::class, ProductRepository::class);

        $this->app->bind(BrandRepository::class, BrandRepository::class);

        $this->app->bind(CategoryRepository::class, CategoryRepository::class);

        $this->app->bind(UserRepository::class, UserRepository::class);

        // Using for ProductController
        $this->app->bind(ProductService::class, function ($app) {
            return new ProductServiceImpl(
                $app->make(ProductRepository::class),
                $app->make(BrandRepository::class)
            ); // or pass dependencies
        });

        // Using for ProductController
        $this->app->bind(CategoryService::class, function ($app) {
            return new CategoryServiceImpl(
                $app->make(CategoryRepository::class)
            );
        });

        // Using for CartController
        $this->app->bind(CartService::class, CartServiceImpl::class);

        // Using for OrderController
        $this->app->bind(OrderService::class, function ($app) {
            return new OrderServiceImpl(
                $app->make(OrderRepository::class)
            );
        });

        // Using for UserController
        $this->app->bind(UserService::class, function ($app) {
            return new UserServiceImpl(
                $app->make(UserRepository::class)
            );
        });

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
