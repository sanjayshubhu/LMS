@extends('layouts.masters')

@section('content')
<div class="flex min-h-screen">
    <!-- Sidebar -->
    <div class="w-64 bg-white shadow-md p-6">
        <h1 class="text-2xl font-bold mb-6">Admin Dashboard</h1>
         <p class="text-gray-600 mb-8">Manage books, users, and borrow records from here.</p>
        <button class="tab-btn w-full text-left mb-2 bg-gray-200 px-4 py-2 rounded" data-target="books-section">Books</button>
        <button class="tab-btn w-full text-left mb-2 px-4 py-2 rounded" data-target="users-section">Users</button>
        <button class="tab-btn w-full text-left mb-2 px-4 py-2 rounded" data-target="borrow-section">Borrow Records</button>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-6">
        @include('pages.dashboard.admin_dashboard.partials._books')
        @include('pages.dashboard.admin_dashboard.partials._users')
        @include('pages.dashboard.admin_dashboard.partials._borrow_records')
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.tab-btn');
    const sections = document.querySelectorAll('.tab-section');

    // Get section from URL
    const urlParams = new URLSearchParams(window.location.search);
    const activeTab = urlParams.get('tab') || 'books-section';

    sections.forEach(section => section.classList.add('hidden'));
    document.getElementById(activeTab).classList.remove('hidden');

    tabs.forEach(tab => {
        tab.classList.remove('bg-gray-200');
        if(tab.dataset.target === activeTab) tab.classList.add('bg-gray-200');
        tab.addEventListener('click', () => {
            sections.forEach(section => section.classList.add('hidden'));
            document.getElementById(tab.dataset.target).classList.remove('hidden');

            tabs.forEach(t => t.classList.remove('bg-gray-200'));
            tab.classList.add('bg-gray-200');

            // Update URL without reloading page
            const newUrl = new URL(window.location);
            newUrl.searchParams.set('tab', tab.dataset.target);
            window.history.pushState({}, '', newUrl);
        });
    });
});

</script>
@endsection