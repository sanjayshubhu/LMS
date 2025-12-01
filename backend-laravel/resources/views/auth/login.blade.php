@extends('layouts.masters')

@section('content')
<div class="flex items-center justify-center bg-gray-100 py-10">
    <div class="w-full max-w-md">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <h3 class="text-2xl font-semibold text-center mb-6">Login</h3>

                <!-- Display session error -->
                @if (session('error'))
                    <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" novalidate class="space-y-4">
                    @csrf
                    <div>
                        <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
                        <input type="email" name="email" id="email" placeholder="Enter your email"
                               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                               required>
                        <p class="mt-1 text-sm text-red-500 hidden">Please enter a valid email.</p>
                    </div>

                    <div>
                        <label for="password" class="block text-gray-700 font-medium mb-1">Password</label>
                        <input type="password" name="password" id="password" placeholder="Enter your password"
                               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                               required minlength="6">
                        <p class="mt-1 text-sm text-red-500 hidden">Password must be at least 6 characters.</p>
                    </div>

                    <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                        Login
                    </button>
                </form>

                <p class="text-center text-gray-600 mt-4">
                    Don't have an account? 
                    <a href="{{ route('register.view') }}" class="text-blue-600 hover:underline">Register here</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/form-validation.js') }}"></script>
@endsection
