<div id="borrow-section" class="tab-section hidden">
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
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Book</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Borrowed
                                    Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Returned
                                    Date</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($borrowRecords as $record)
                                <tr>
                                    <td class="px-6 py-4 text-gray-800 font-medium">
                                        {{ $record->user->name }}
                                    </td>

                                    <td class="px-6 py-4 text-gray-800">
                                        {{ $record->book->title }}
                                    </td>

                                    {{-- Status Badge --}}
                                    <td class="px-6 py-4">
                                        @if ($record->return_date)
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold 
                        rounded-full bg-green-100 text-green-800">
                                                Returned
                                            </span>
                                        @else
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold 
                        rounded-full bg-yellow-100 text-yellow-800">
                                                Borrowed
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Quantity (always 1 for borrow) --}}
                                    <td class="px-6 py-4 text-gray-800 text-center">
                                        1
                                    </td>

                                    <td class="px-6 py-4 text-gray-600">
                                        {{ $record->borrow_date?->format('d M Y') }}
                                    </td>

                                    <td class="px-6 py-4 text-gray-600">
                                        @if ($record->return_date)
                                            {{-- Returned Date --}}
                                            <span class="text-green-700 font-semibold">
                                                {{ $record->return_date->format('d M Y') }}
                                            </span>
                                        @else
                                            {{-- Show button only if NOT returned --}}
                                            <button
                                                class="mark-return bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm"
                                                data-id="{{ $record->id }}">
                                                Mark as Returned
                                            </button>

                                            <span class="ml-2 text-gray-400 italic text-sm">
                                                Not returned yet
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                    <!-- Pagination Links -->
                    <div class="mt-4">
                        {{ $borrowRecords->appends(['tab' => 'borrow-section'])->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
