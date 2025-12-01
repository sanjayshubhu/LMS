@extends('layouts.masters')

@section('content')
    <div class="min-h-screen bg-gray-100 py-10">
        <div class="max-w-7xl mx-auto px-4 space-y-8">

            <!-- Welcome Card -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Admin Dashboard</h1>
                <p class="text-gray-600">Manage books, users, and borrow records from here.</p>
            </div>

            <!-- Books Section -->
            <!-- Books Section -->
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
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($books as $book)
                                        <tr>
                                            <td class="px-6 py-4 text-gray-800 font-medium">{{ $book->title }}</td>

                                            <td class="px-6 py-4 text-gray-600">{{ $book->quantity }}</td>

                                            <td class="px-6 py-4 flex space-x-3">

                                                <!-- Edit Button -->
                                                <a href="{{ route('books.edit', $book->id) }}"
                                                    class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white text-sm rounded-md">
                                                    Edit
                                                </a>

                                                <!-- Delete Button -->
                                                <button onclick="openDeleteModal({{ $book->id }})"
                                                    class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white text-sm rounded-md">
                                                    Delete
                                                </button>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    @endif
                </div>
            </div>


            <!-- Users Section -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-2xl font-semibold text-gray-800">Users</h2>
                </div>
                <div class="p-6">
                    @if ($users->isEmpty())
                        <p class="text-gray-500">No users found.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Name</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Role</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-800 font-medium">
                                                {{ $user->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ ucfirst($user->role) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Borrow Records Section -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-2xl font-semibold text-gray-800">Borrow Records</h2>
                </div>
                <div class="p-6">
                    @if ($borrowRecords->isEmpty())
                        <p class="text-gray-500">No borrow records found.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            User</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Book</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Borrowed Date</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Returned Date</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($borrowRecords as $record)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-800 font-medium">
                                                {{ $record->user->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-800">{{ $record->book->title }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            {{ $record->status == 'returned' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                    {{ ucfirst($record->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-600">
                                                {{ $record->borrowed_at->format('d M Y') }}</td>
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


            <!-- ⬇️ Put the delete modal HERE — at the very bottom -->
            <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
                <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                    <h2 class="text-xl font-bold mb-4 text-gray-800">Confirm Delete</h2>
                    <p class="text-gray-600 mb-6">Are you sure you want to delete this book?</p>

                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')

                        <div class="flex justify-end space-x-3">
                            <button type="button" onclick="closeDeleteModal()"
                                class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-lg text-sm">
                                Cancel
                            </button>

                            <button type="submit"
                                class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm">
                                Delete
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <script>
                function openDeleteModal(id) {
                    let form = document.getElementById('deleteForm');
                    form.action = "/books/" + id;
                    document.getElementById('deleteModal').classList.remove('hidden');
                    document.getElementById('deleteModal').classList.add('flex');
                }

                function closeDeleteModal() {
                    document.getElementById('deleteModal').classList.add('hidden');
                }
            </script>
        </div>
    </div>
@endsection
