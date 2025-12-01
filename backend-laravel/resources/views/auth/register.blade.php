@extends('layouts.masters')

@section('content')
<div class="flex items-center justify-center bg-gray-100 py-10">
    <div class="w-full max-w-md">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <h3 class="text-2xl font-semibold text-center mb-6">Register</h3>

                <!-- Display validation errors -->
                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
                        <ul class="list-disc list-inside mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" novalidate class="space-y-4">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-gray-700 font-medium mb-1">Name</label>
                        <input type="text" name="name" id="name" placeholder="Enter your name"
                               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                               required>
                        <p class="mt-1 text-sm text-red-500 hidden">Please enter your name.</p>
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
                        <input type="email" name="email" id="email" placeholder="Enter your email"
                               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                               required>
                        <p class="mt-1 text-sm text-red-500 hidden">Please enter a valid email.</p>
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-gray-700 font-medium mb-1">Password</label>
                        <input type="password" name="password" id="password" placeholder="Enter password"
                               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                               required minlength="6">
                        <p class="mt-1 text-sm text-red-500 hidden">Password must be at least 6 characters.</p>
                    </div>

                    <!-- Role selection (only for admins) -->
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <div>
                                <label for="role" class="block text-gray-700 font-medium mb-1">Role</label>
                                <select name="role" id="role"
                                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                        @else
                            <input type="hidden" name="role" value="user">
                        @endif
                    @else
                        <input type="hidden" name="role" value="user">
                    @endauth

                    <!-- Submit button -->
                    <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                        Register
                    </button>
                </form>

                <!-- Login link -->
                <p class="text-center text-gray-600 mt-4">
                    Already have an account? 
                    <a href="{{ route('login.view') }}" class="text-blue-600 hover:underline">Login here</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
