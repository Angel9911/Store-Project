@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded shadow text-center">
        <h2 class="text-2xl font-bold text-green-600 mb-4">✅ Order Placed Successfully!</h2>

        <p class="mb-4">Thank you for your purchase. Your order ID is <span class="font-semibold">{{ $orderId }}</span>.</p>

        @auth
            <a href="{{ route('orders.index') }}"
               class="inline-block bg-indigo-600 text-white px-5 py-2 rounded hover:bg-indigo-700">
                View Your Orders
            </a>
        @else
            <a href="{{ route('home') }}"
               class="inline-block bg-gray-700 text-white px-5 py-2 rounded hover:bg-gray-800">
                Return to Home
            </a>
        @endauth
    </div>
@endsection
