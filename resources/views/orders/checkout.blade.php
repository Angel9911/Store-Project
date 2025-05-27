@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Checkout</h2>

        @if(session('error'))
            <p class="text-red-500 mb-4">{{ session('error') }}</p>
        @endif

        <form action="{{ route('orders.create') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block mb-1 font-semibold">Full Name</label>
                <input type="text" name="name" class="w-full border p-2 rounded" required>
            </div>

            <div>
                <label class="block mb-1 font-semibold">Email</label>
                <input type="email" name="email" class="w-full border p-2 rounded" required>
            </div>

            <div>
                <label class="block mb-1 font-semibold">Phone</label>
                <input type="text" name="phone" class="w-full border p-2 rounded" required>
            </div>

            <div>
                <label class="block mb-1 font-semibold">Address</label>
                <textarea name="address" class="w-full border p-2 rounded" rows="3" required></textarea>
            </div>

            <div class="border-t pt-4">
                <h3 class="text-lg font-semibold mb-2">Order Summary</h3>
                <ul class="mb-4">
                    @foreach ($cartItems as $item)
                        <li class="flex justify-between border-b py-1">
                            <span>Product name: {{ $item['product_name'] }} (x{{ $item['quantity'] }})</span>
                            <span>${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                        </li>
                    @endforeach
                </ul>

                <div class="text-right font-bold text-lg">
                    Total: ${{ number_format($total, 2) }}
                </div>
            </div>

            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">
                Place Order
            </button>
        </form>
    </div>
@endsection
