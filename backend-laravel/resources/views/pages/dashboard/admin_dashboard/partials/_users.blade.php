<div id="users-section" class="tab-section hidden">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
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
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($users as $user)
                                <tr>
                                    <td class="px-6 py-4 text-gray-800 font-medium">{{ $user->name }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ ucfirst($user->role) }}</td>
                                    <td class="px-6 py-4 flex space-x-2">
                                        @if(auth()->user()->id !== $user->id) {{-- prevent deleting self --}}
                                            <button type="button"
                                                class="px-3 py-1 bg-red-600 text-white rounded text-sm hover:bg-red-700"
                                                onclick="confirmDeleteUser({{ $user->id }})">
                                                Delete
                                            </button>
                                            {{-- Hidden delete form --}}
                                            <form id="delete-user-form-{{ $user->id }}"
                                                action="{{ route('users.destroy', $user->id) }}"
                                                method="POST" class="hidden">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination Links -->
                    <div class="mt-4">
                        {{ $users->appends(['tab' => 'users-section'])->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    window.confirmDeleteUser = function(userId) {
        if (confirm('Are you sure you want to delete this user?')) {
            document.getElementById(`delete-user-form-${userId}`).submit();
        }
    }
</script>
