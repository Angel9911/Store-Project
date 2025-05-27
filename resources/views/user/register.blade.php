@extends('layouts.app')

@section('content')
    <h1 class="text-xl font-bold mb-4">Register</h1>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf
        <input type="text" name="name" placeholder="Name" required class="w-full p-2 border border-gray-300 rounded">
        <input type="email" name="email" placeholder="Email" required class="w-full p-2 border border-gray-300 rounded">
        <input type="password" name="password" placeholder="Password" required class="w-full p-2 border border-gray-300 rounded">
        <input type="password" name="password_confirmation" placeholder="Confirm Password" required class="w-full p-2 border border-gray-300 rounded">
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Register</button>
    </form>
@endsection
