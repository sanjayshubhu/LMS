@extends('layouts.masters')

@section('content')
<div class="min-h-screen bg-gray-100 py-10">
    <div class="max-w-6xl mx-auto px-4">
        <h3 class="text-2xl font-semibold mb-6">Library Books</h3>

        <!-- Flash messages -->
        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="mb-4">
            <a href="{{ route('books.create') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition-colors">
                Add Book
            </a>
        </div>

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($books as $book)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $book->title }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $book->author }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $book->quantity }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($book->quantity > 0)
                                    <form method="POST" action="{{ route('books.borrow', $book->id) }}">
                                        @csrf
                                        <button type="submit" 
                                                class="bg-green-600 hover:bg-green-700 text-white text-sm font-semibold py-1 px-3 rounded transition-colors">
                                            Borrow
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-400 text-sm">Not Available</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    @if($books->isEmpty())
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">No books available.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
