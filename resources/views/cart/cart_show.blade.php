@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto bg-white shadow p-6 rounded-md">
        <h2 class="text-2xl font-bold mb-6">Your Cart</h2>

        @if(count($cartItems) > 0)
            <table class="w-full mb-6 border-collapse">
                <thead>
                <tr class="text-left border-b">
                    <th class="p-2">Product ID</th>
                    <th class="p-2">Quantity</th>
                    <th class="p-2">Price</th>
                    <th class="p-2">Subtotal</th>
                    <th class="p-2"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($cartItems as $item)
                    <tr class="border-b">
                        <td class="p-2">{{ $item['product_id'] }}</td>
                        <td class="p-2">{{ $item['quantity'] }}</td>
                        <td class="p-2">${{ number_format($item['price'], 2) }}</td>
                        <td class="p-2">${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                        <td class="p-2">
                            <form action="{{ route('cart.remove', $item['product_id']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="text-right text-xl font-semibold mb-4">
                Total: ${{ number_format($total, 2) }}
            </div>

            <div class="flex justify-between items-center">
                <form action="{{ route('cart.clear') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="text-sm text-red-600 hover:underline">Clear Cart</button>
                </form>

                <a href="{{ route('checkout.form') }}" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">
                    Proceed to Checkout
                </a>
            </div>
        @else
            <p>Your cart is empty.</p>
        @endif
    </div>
@endsection
