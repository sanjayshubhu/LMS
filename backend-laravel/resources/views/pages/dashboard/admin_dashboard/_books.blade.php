<div id="books-section" class="tab-section">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h2 class="text-2xl font-semibold text-gray-800">Books</h2>
            <a href="{{ route('books.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                + Add New Book
            </a>
        </div>
        <div class="p-6">
            @if ($books->isEmpty())
                <p class="text-gray-500">No books available.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Author</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ISBN</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($books as $book)
                                <tr class="hover:bg-gray-50 transition">
                                    {{-- Title --}}
                                    <td class="px-6 py-4">
                                        <span id="title-display-{{ $book->id }}">{{ $book->title }}</span>
                                        <input type="text" id="title-input-{{ $book->id }}" value="{{ $book->title }}"
                                               class="border rounded px-2 py-1 w-full hidden">
                                    </td>

                                    {{-- Quantity --}}
                                    <td class="px-6 py-4">
                                        <span id="quantity-display-{{ $book->id }}">{{ $book->quantity }}</span>
                                        <input type="number" id="quantity-input-{{ $book->id }}" value="{{ $book->quantity }}"
                                               class="border rounded px-2 py-1 w-full hidden">
                                    </td>

                                    {{-- Author --}}
                                    <td class="px-6 py-4">
                                        <span id="author-display-{{ $book->id }}">{{ $book->author }}</span>
                                        <input type="text" id="author-input-{{ $book->id }}" value="{{ $book->author }}"
                                               class="border rounded px-2 py-1 w-full hidden">
                                    </td>

                                    {{-- Category --}}
                                    <td class="px-6 py-4">
                                        <span id="category-display-{{ $book->id }}">{{ $book->category }}</span>
                                        <input type="text" id="category-input-{{ $book->id }}" value="{{ $book->category }}"
                                               class="border rounded px-2 py-1 w-full hidden">
                                    </td>

                                    {{-- ISBN --}}
                                    <td class="px-6 py-4">
                                        <span id="isbn-display-{{ $book->id }}">{{ $book->isbn }}</span>
                                        <input type="text" id="isbn-input-{{ $book->id }}" value="{{ $book->isbn }}"
                                               class="border rounded px-2 py-1 w-full hidden">
                                    </td>

                                    {{-- Actions --}}
                                    <td class="px-6 py-4 flex space-x-2">
                                        <button type="button" id="edit-btn-{{ $book->id }}"
                                                class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded text-sm font-medium"
                                                onclick="enableEdit({{ $book->id }})">
                                            Edit
                                        </button>
                                        <button type="button" id="save-btn-{{ $book->id }}"
                                                class="px-3 py-1 bg-green-500 hover:bg-green-600 text-white rounded text-sm font-medium hidden"
                                                onclick="saveEdit({{ $book->id }})">
                                            Save
                                        </button>
                                        <button type="button"
                                                class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded text-sm font-medium"
                                                onclick="confirmDelete({{ $book->id }})">
                                            Delete
                                        </button>

                                        {{-- Hidden delete form --}}
                                        <form id="delete-form-{{ $book->id }}" action="{{ route('books.destroy', $book->id) }}" method="POST" class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- Pagination --}}
                    <div class="mt-4">
                        {{ $books->appends(['tab' => 'books-section'])->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
