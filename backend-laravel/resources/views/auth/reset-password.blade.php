@extends('layouts.masters')

@section('content')
<div class="flex items-center justify-center bg-gray-100 py-10">
    <div class="w-full max-w-md">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <h3 class="text-2xl font-semibold text-center mb-6">Reset Password</h3>

                <!-- Display session status -->
                @if (session('status'))
                    <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            placeholder="Enter your email"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('email')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- New Password -->
                    <div>
                        <label for="password" class="block text-gray-700 font-medium mb-1">New Password</label>
                        <input id="password" type="password" name="password" required
                            placeholder="Enter new password"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('password')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-gray-700 font-medium mb-1">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                            placeholder="Confirm new password"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                        Reset Password
                    </button>
                </form>

                <p class="text-center text-gray-600 mt-4">
                    Remember your password?
                    <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login here</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
