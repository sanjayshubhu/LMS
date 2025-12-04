<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
        <h2 class="text-2xl font-semibold text-gray-800">available Books</h2>
        <input type="text" id="searchBook" placeholder="Search books..."
               class="border px-3 py-2 rounded w-64 focus:outline-none focus:ring-2 focus:ring-blue-400">
    </div>

    <div class="p-6">
        <div id="booksContainer">
            @if ($books->isEmpty())
                <p class="text-gray-500">No books available for borrowing at the moment.</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($books as $book)
                        <div class="border rounded-lg p-4 shadow hover:shadow-lg transition duration-200 flex flex-col justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $book->title }}</h3>
                                <p class="text-gray-600 mb-4">Quantity: {{ $book->quantity }}</p>
                            </div>
                            <form action="{{ route('books.borrow', $book->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-200">
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
