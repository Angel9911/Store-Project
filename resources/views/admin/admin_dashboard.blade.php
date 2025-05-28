@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="p-6 bg-gradient-to-br from-indigo-100 to-purple-200 min-h-screen">
        <div class="max-w-5xl mx-auto bg-white rounded-lg shadow p-6">
            <h1 class="text-3xl font-bold text-purple-700 mb-6">Admin Panel</h1>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Category Section -->
                <div class="bg-indigo-50 p-4 rounded shadow">
                    <h2 class="text-lg font-semibold text-indigo-700 mb-2">Add Category</h2>

                    @if ($errors->has('name'))
                        <div class="text-red-500 text-sm">{{ $errors->first('name') }}</div>
                    @endif

                    <form action="{{ route('admin.categories.create') }}" method="POST" class="space-y-2">
                        @csrf
                        <input type="text" name="name" placeholder="Category name"
                               class="w-full border rounded p-2 @error('name') border-red-500 @enderror" required>
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-1 rounded hover:bg-indigo-700">
                            Add Category
                        </button>
                    </form>
                </div>

                <!-- Brand Section -->
                <div class="bg-green-50 p-4 rounded shadow">
                    <h2 class="text-lg font-semibold text-green-700 mb-2">Add Brand</h2>

                    @if ($errors->has('name'))
                        <div class="text-red-500 text-sm">{{ $errors->first('name') }}</div>
                    @endif

                    <form action="{{ route('admin.brands.create') }}" method="POST" class="space-y-2">
                        @csrf
                        <input type="text" name="name" placeholder="Brand name"
                               class="w-full border rounded p-2 @error('name') border-red-500 @enderror" required>
                        <button type="submit" class="bg-green-600 text-white px-4 py-1 rounded hover:bg-green-700">
                            Add Brand
                        </button>
                    </form>
                </div>

                <!-- Product Section -->
                <div class="bg-yellow-50 p-4 rounded shadow">
                    <h2 class="text-lg font-semibold text-yellow-700 mb-2">Add Product</h2>
                    <form action="#" method="POST" class="space-y-2">
                        @csrf
                        <input type="text" name="product_name" placeholder="Product name"
                               class="w-full border rounded p-2">
                        <input type="number" name="price" placeholder="Price"
                               class="w-full border rounded p-2">
                        <select name="category_id" class="w-full border rounded p-2">
                            <option disabled selected>Choose Category</option>
                            {{-- Dynamically fill from DB --}}
                        </select>
                        <select name="brand_id" class="w-full border rounded p-2">
                            <option disabled selected>Choose Brand</option>
                            {{-- Dynamically fill from DB --}}
                        </select>
                        <button type="submit" class="bg-yellow-600 text-white px-4 py-1 rounded hover:bg-yellow-700">
                            Add Product
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
