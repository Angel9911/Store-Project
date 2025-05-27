@extends('layouts.app')

@section('content')
    <h1 class="text-xl font-bold mb-4">Login</h1>

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf
        <input type="email" name="email" placeholder="Email" required class="w-full p-2 border border-gray-300 rounded">
        <input type="password" name="password" placeholder="Password" required class="w-full p-2 border border-gray-300 rounded">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Login</button>
    </form>
@endsection
