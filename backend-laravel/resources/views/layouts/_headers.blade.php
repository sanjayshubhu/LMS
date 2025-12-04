<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'LMS') }}</title>
    <script src="//unpkg.com/alpinejs" defer></script>
<!-- Toastify CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">




    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 ">
    <!-- Navbar -->
    <nav class="bg-gray-800 p-4 text-white flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <a href="{{ url('/') }}" class="font-bold text-lg">LMS</a>

            @auth
                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="hover:underline">Admin Dashboard</a>
                    <a href="{{ route('books.create') }}" class="hover:underline">Add Book</a>
                @else
                    <a href="{{ route('user.dashboard') }}" class="hover:underline">User Dashboard</a>
                    {{-- Only show Borrow button if $book exists --}}
                    @isset($book)
                        <form action="{{ route('books.borrow', $book->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                Borrow Book
                            </button>
                        </form>
                    @endisset
                @endif
            @endauth

        </div>

        <div class="flex items-center space-x-4">
            @guest
                <a href="{{ route('login.view') }}" class="hover:underline">Login</a>
                <a href="{{ route('register.view') }}" class="hover:underline">Register</a>
            @else
                <span class="font-medium">{{ auth()->user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="hover:underline">Logout</button>
                </form>
            @endguest
        </div>
    </nav>
    </nav>
