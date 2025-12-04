@extends('layouts.masters')

@section('content')
<div class="min-h-screen bg-gray-100 py-10 flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-md rounded-lg p-6 mr-6">
        <h2 class="text-xl font-bold mb-6">Dashboard</h2>
        <ul>
            <li class="mb-3">
                <button id="showBorrowed" class="block w-full text-left px-4 py-2 rounded bg-blue-500 text-white">
                    Borrowed Books
                </button>
            </li>
            <li>
                <button id="showAvailable"
                    class="block w-full text-left px-4 py-2 rounded text-gray-700 hover:bg-gray-200">
                    Available Books
                </button>
            </li>
        </ul>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1">

        <!-- Borrowed Books (default visible) -->
        <div id="borrowedBooks">
            @include('pages.dashboard.user_dashboard.partials._borrowed-books')
        </div>

        <!-- Available Books (hidden initially) -->
        <div id="availableBooks" class="hidden">
            @include('pages.dashboard.user_dashboard.partials._available-books')
        </div>

    </div>

</div>
@endsection

@section('scripts')
<script>
    const borrowedBtn = document.getElementById('showBorrowed');
    const availableBtn = document.getElementById('showAvailable');
    
    const borrowedDiv = document.getElementById('borrowedBooks');
    const availableDiv = document.getElementById('availableBooks');

    // Show Borrowed Books
    borrowedBtn.addEventListener('click', () => {

        borrowedDiv.classList.remove('hidden');
        availableDiv.classList.add('hidden');

        borrowedBtn.classList.add('bg-blue-500', 'text-white');
        borrowedBtn.classList.remove('text-gray-700', 'hover:bg-gray-200');

        availableBtn.classList.remove('bg-blue-500', 'text-white');
        availableBtn.classList.add('text-gray-700', 'hover:bg-gray-200');
    });

    // Show Available Books
    availableBtn.addEventListener('click', () => {

        borrowedDiv.classList.add('hidden');
        availableDiv.classList.remove('hidden');

        availableBtn.classList.add('bg-blue-500', 'text-white');
        availableBtn.classList.remove('text-gray-700', 'hover:bg-gray-200');

        borrowedBtn.classList.remove('bg-blue-500', 'text-white');
        borrowedBtn.classList.add('text-gray-700', 'hover:bg-gray-200');
    });
</script>
@endsection
