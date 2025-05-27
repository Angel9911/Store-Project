<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Online Store</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">

{{-- Navbar --}}
<nav class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
        <a href="{{ route('home.index') }}" class="text-xl font-bold"> Store</a>

        <div class="flex space-x-4">
            @auth
                <a href="{{ route('orders.orders_show') }}" class="hover:underline">My Orders</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="hover:underline">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="hover:underline">Login</a>
                <a href="{{ route('register') }}" class="hover:underline">Register</a>
            @endauth

            <a href="{{ route('cart.cart_show') }}" class="hover:underline">Cart</a>
        </div>
    </div>
</nav>

{{-- Category Filter --}}
@if(isset($categories))
    <div class="bg-gray-100 border-t border-b py-3 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 flex flex-wrap gap-4">
            <a href="{{ route('home.index') }}" class="text-blue-600 font-semibold hover:underline">All</a>
            @foreach($categories as $category)
                <a href="{{ route('home.index', ['category_id' => $category->id]) }}"
                   class="text-gray-700 hover:text-blue-500 hover:underline">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </div>
@endif


<main class="p-6">
    @yield('content')
</main>
</body>
</html>
