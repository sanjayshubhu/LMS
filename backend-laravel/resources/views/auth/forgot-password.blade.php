@extends('layouts.masters')

@section('content')
<div class="flex items-center justify-center py-10">
    <div class="w-full max-w-md">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-2xl font-semibold text-center mb-6">Forgot Password</h3>

            @if (session('status'))
                <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
                    <input type="email" name="email" id="email"
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg">
                    Send Password Reset Link
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
