@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Your Orders</h1>

        @if($orders->isEmpty())
            <p class="text-gray-600">You haven't placed any orders yet.</p>
            <a href="{{ route('home') }}" class="text-blue-600 hover:underline mt-2 inline-block">Go shopping</a>
        @else
            <div class="space-y-6">
                @foreach($orders as $order)
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <div class="flex justify-between items-center mb-2">
                            <div>
                                <h2 class="font-semibold">Order #{{ $order->id }}</h2>
                                <p class="text-sm text-gray-600">Placed on {{ $order->created_at->format('F j, Y H:i') }}</p>
                            </div>
                            <a href="{{ route('orders.show', $order->id) }}"
                               class="text-blue-600 hover:underline text-sm">View Details</a>
                        </div>
                        <div class="text-gray-800">
                            <p><strong>Total:</strong> ${{ number_format($order->total, 2) }}</p>
                            <p><strong>Status:</strong> {{ ucfirst($order->status ?? 'completed') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
