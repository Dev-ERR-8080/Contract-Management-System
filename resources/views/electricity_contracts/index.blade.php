@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="m-6">
        <x-back-button url="{{ route('electricity.dashboard') }}" label="🏠 Go to Electricity Dashboard" />
    </div>

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-semibold text-gray-900">⚡ Electricity Contracts</h1>
        <a href="{{ route('electricity_contracts.create') }}" class="inline-block bg-blue-600 text-white text-sm px-6 py-3 rounded-md hover:bg-blue-700 shadow-md transition">+ Add Contract</a>
    </div>

    <!-- search box -->
    <form method="GET" action="{{ route('electricity_contracts.index') }}" class="mt-4">
        <div class="flex space-x-4">
            <input type="text" name="search" class="px-4 py-2 border border-gray-300 rounded-md" placeholder="Search by Customer Name or Site Address" value="{{ request()->query('search') }}">
            <select name="status" class="px-4 py-2 border border-gray-300 rounded-md">
                <option value="">All Statuses</option>
                <option value="pending" {{ request()->query('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="in_progress" {{ request()->query('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="completed" {{ request()->query('status') == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md">Search</button>
        </div>
    </form>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg mt-6">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-800 uppercase tracking-wider">Customer Name</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-800 uppercase tracking-wider">Address</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-800 uppercase tracking-wider">Total Cost</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-800 uppercase tracking-wider">Installation Date</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-800 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-800 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($contracts as $contract)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $contract->customer_name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $contract->site_address }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">₹{{ number_format($contract->total_cost, 2) }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $contract->installation_date }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $contract->status }}</td>
                        <td class="px-6 py-4 text-sm font-medium flex gap-2 flex-wrap">
                            <a href="{{ route('electricity_contracts.edit', $contract->_id) }}"
                               class="inline-block px-3 py-1 bg-blue-100 text-blue-700 rounded-full hover:bg-blue-600 hover:text-white transition">
                                ✏️ Edit
                            </a>

                            <form method="POST" action="{{ route('electricity_contracts.destroy', $contract->_id) }}"
                                  class="delete-form inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-3 py-1 bg-red-100 text-red-700 rounded-full hover:bg-red-600 hover:text-white transition">
                                    🗑️ Delete
                                </button>
                            </form>

                            <a href="{{ route('electricity_contracts.show', $contract->_id) }}"
                               class="inline-block px-3 py-1 bg-green-100 text-green-700 rounded-full hover:bg-green-600 hover:text-white transition">
                                👁️ View
                            </a>

                            <!-- <a href="{{ route('electricity.quotes.create', $contract->_id) }}"
                               class="inline-block px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full hover:bg-yellow-500 hover:text-white transition">
                                💬 Quotes
                            </a> -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $contracts->appends(request()->query())->links('pagination::tailwind') }}
    </div>
</div>

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    showConfirmButton: false
                });
            @endif
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "This action can't be undone.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
