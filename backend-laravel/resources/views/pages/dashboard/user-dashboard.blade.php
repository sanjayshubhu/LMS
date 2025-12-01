@extends('layouts.masters')

@section('content')
<div class="min-h-screen bg-gray-100 py-10">
    <div class="max-w-6xl mx-auto px-4 space-y-8">

        <!-- Welcome Card -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Welcome, {{ auth()->user()->name }}!</h1>
            <p class="text-gray-600">Here's a summary of your borrowed books and available books to borrow.</p>
        </div>

        <!-- Borrowed Books Section -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-2xl font-semibold text-gray-800">Borrowed Books</h2>
            </div>
            <div class="p-6">
                @if($borrowedBooks->isEmpty())
                    <p class="text-gray-500">You have not borrowed any books yet.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Borrowed Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Returned Date</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($borrowedBooks as $record)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-800 font-medium">{{ $record->book->title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            {{ $record->status == 'returned' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ ucfirst($record->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $record->borrowed_at->format('d M Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-600">
                                        {{ $record->returned_at ? $record->returned_at->format('d M Y') : 'Not returned yet' }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        <!-- Available Books Section -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-2xl font-semibold text-gray-800">Available Books</h2>
            </div>
            <div class="p-6">
                @if($books->isEmpty())
                    <p class="text-gray-500">No books available for borrowing at the moment.</p>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($books as $book)
                        <div class="border rounded-lg p-4 shadow hover:shadow-lg transition duration-200 flex flex-col justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $book->title }}</h3>
                                <p class="text-gray-600 mb-4">Quantity: {{ $book->quantity }}</p>
                            </div>
                            <form action="{{ route('books.borrow', $book->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-200">
                                    Borrow
                                </button>
                            </form>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection
