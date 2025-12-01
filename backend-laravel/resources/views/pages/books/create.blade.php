@extends('layouts.masters')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 py-10">
    <div class="w-full max-w-md">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <h3 class="text-2xl font-semibold text-center mb-6">Add Book</h3>

                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
                        <ul class="list-disc list-inside mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('books.store') }}" class="space-y-4" novalidate>
                    @csrf

                    <div>
                        <label for="title" class="block text-gray-700 font-medium mb-1">Book Title</label>
                        <input type="text" name="title" id="title" placeholder="Enter book title"
                               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                               required>
                        <p class="mt-1 text-sm text-red-500 hidden">Please enter the book title.</p>
                    </div>

                    <div>
                        <label for="author" class="block text-gray-700 font-medium mb-1">Author</label>
                        <input type="text" name="author" id="author" placeholder="Enter author name"
                               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                               required>
                        <p class="mt-1 text-sm text-red-500 hidden">Please enter the author's name.</p>
                    </div>

                    <div>
                        <label for="category" class="block text-gray-700 font-medium mb-1">Category</label>
                        <input type="text" name="category" id="category" placeholder="Enter book category"
                               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                               required>
                        <p class="mt-1 text-sm text-red-500 hidden">Please enter the category.</p>
                    </div>

                    <div>
                        <label for="isbn" class="block text-gray-700 font-medium mb-1">ISBN</label>
                        <input type="text" name="isbn" id="isbn" placeholder="Enter ISBN number"
                               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                               required>
                        <p class="mt-1 text-sm text-red-500 hidden">Please enter a valid ISBN.</p>
                    </div>

                    <div>
                        <label for="quantity" class="block text-gray-700 font-medium mb-1">Quantity</label>
                        <input type="number" name="quantity" id="quantity" placeholder="Enter quantity" min="1"
                               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                               required>
                        <p class="mt-1 text-sm text-red-500 hidden">Quantity must be at least 1.</p>
                    </div>

                    <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                        Add Book
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

