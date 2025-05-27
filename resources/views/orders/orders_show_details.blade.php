@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Order #{{ $order->id }}</h2>

        <p class="text-gray-700 mb-2"><strong>Placed on:</strong> {{ $order->created_at->format('F j, Y H:i') }}</p>
        <p class="text-gray-700 mb-2"><strong>Total:</strong> ${{ number_format($order->totalPrice, 2) }}</p>
        <p class="text-gray-700 mb-2"><strong>Status:</strong> {{ ucfirst($order->status ?? 'completed') }}</p>

        <div class="border-t mt-4 pt-4">
            <h3 class="text-lg font-semibold mb-2">Shipping Details</h3>
            <p><strong>Name:</strong> {{ $order->name }}</p>
            <p><strong>Email:</strong> {{ $order->email }}</p>
            <p><strong>Phone:</strong> {{ $order->phone }}</p>
            <p><strong>Address:</strong> {{ $order->address }}</p>
        </div>

        <div class="border-t mt-4 pt-4">
            <h3 class="text-lg font-semibold mb-2">Ordered Products</h3>

            @foreach($order->orderProducts as $item)
                <div class="border-b py-2 flex justify-between">
                    <div>
                        <p><strong>{{ $item->product->name }}</strong></p>
                        <p class="text-sm text-gray-600">Qty: {{ $item->quantity }}</p>
                    </div>
                    <div>
                        <p>${{ number_format($item->price, 2) }}</p>
                        <p class="text-sm text-gray-600">Subtotal: ${{ number_format($item->subtotal, 2) }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
