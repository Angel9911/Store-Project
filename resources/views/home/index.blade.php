@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Available Products</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($products as $product)
            <div class="bg-white rounded-lg shadow-md p-4 flex flex-col">
                <h2 class="font-bold text-lg mb-2">{{ $product->name }}</h2>
                <p class="text-sm text-gray-600">{{ Str::limit($product->description, 60) }}</p>
                <p class="text-indigo-600 font-bold mt-2">${{ number_format($product->price, 2) }}</p>
                <a href="{{ route('products.details_show', $product->id) }}" class="mt-auto text-blue-500 hover:underline text-sm">View Details</a>
            </div>
        @empty
            <p>No products available.</p>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $products->links() }}
    </div>
@endsection
