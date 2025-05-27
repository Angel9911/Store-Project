@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
        <div class="mb-4">
            <a href="{{ route('products.index') }}" class="text-sm text-blue-600 hover:underline">&larr; Back to products</a>
        </div>

        <h1 class="text-3xl font-bold mb-2">{{ $product->name }}</h1>

        @if($product->category)
            <p class="text-sm text-gray-500 mb-1">Category: {{ $product->category->name }}</p>
        @endif

        @if($product->brand)
            <p class="text-sm text-gray-500 mb-4">Brand: {{ $product->brand->name }}</p>
        @endif

        <p class="text-gray-800 mb-4">{{ $product->description }}</p>

        <div class="text-xl text-green-600 font-semibold mb-6">${{ number_format($product->price, 2) }}</div>

        <form action="{{ route('cart.add') }}" method="POST" class="flex items-center gap-4">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <label for="quantity" class="text-sm">Quantity:</label>
            <input type="number" name="quantity" id="quantity" value="1" min="1" class="w-20 p-1 border rounded">
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                Add to Cart
            </button>
        </form>
    </div>
@endsection
