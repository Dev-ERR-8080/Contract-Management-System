{{-- resources/views/solar_contracts/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-semibold text-gray-900">Edit Solar Contract</h1>
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">

    <form method="POST" action="{{ route('solar_contracts.update', $contract->_id) }}" class="mt-8 space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="customer_name" class="block text-sm font-medium text-gray-700">Customer Name</label>
                <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name', $contract->customer_name) }}" required class="mt-1 block w-full border px-4 py-2 rounded-md">
            </div>

            <div>
                <label for="site_address" class="block text-sm font-medium text-gray-700">Site Address</label>
                <input type="text" name="site_address" id="site_address" value="{{ old('site_address', $contract->site_address) }}" required class="mt-1 block w-full border px-4 py-2 rounded-md">
            </div>

            <div>
                <label for="total_cost" class="block text-sm font-medium text-gray-700">Total Cost (₹)</label>
                <input type="number" name="total_cost" id="total_cost" value="{{ old('total_cost', $contract->total_cost) }}" required class="mt-1 block w-full border px-4 py-2 rounded-md">
            </div>

            <div>
                <label for="installation_date" class="block text-sm font-medium text-gray-700">Installation Date</label>
                <input type="date" name="installation_date" id="installation_date" value="{{ old('installation_date', \Carbon\Carbon::parse($contract->installation_date)->format('Y-m-d')) }}" required class="mt-1 block w-full border px-4 py-2 rounded-md">
            </div>

            <div class="md:col-span-2">
                <label for="product_ids" class="block text-sm font-medium text-gray-700">Select Products</label>
                <select name="product_ids[]" id="product_ids" multiple class="mt-1 block w-full border px-4 py-2 rounded-md">
                    @foreach($products as $product)
                        <option value="{{ $product->_id }}" @selected(in_array($product->_id, $contract->product_ids ?? []))>{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" class="mt-1 block w-full border px-4 py-2 rounded-md">
                    <option value="pending" {{ old('status', $contract->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in_progress" {{ old('status', $contract->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="completed" {{ old('status', $contract->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            <div>
                <label for="assigned_to" class="block text-sm font-medium text-gray-700">Assigned To</label>
                <input type="text" name="assigned_to" id="assigned_to" value="{{ old('assigned_to', $contract->assigned_to) }}" class="mt-1 block w-full border px-4 py-2 rounded-md">
            </div>

            <div class="md:col-span-2">
                <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                <textarea name="notes" id="notes" rows="3" class="mt-1 block w-full border px-4 py-2 rounded-md">{{ old('notes', $contract->notes) }}</textarea>
            </div>

            <div class="md:col-span-2">
                <label for="progress_updates" class="block text-sm font-medium text-gray-700">Progress Updates</label>
                <textarea name="progress_updates[]" id="progress_updates" rows="3" class="mt-1 block w-full border px-4 py-2 rounded-md" placeholder="Enter update">{{ old('progress_updates.0', $contract->progress_updates[0] ?? '') }}</textarea>
            </div>
        </div>

        <div class="mt-8 flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 transition">Update Contract</button>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <script>
        new TomSelect('#product_ids', {
            plugins: ['remove_button'],
            placeholder: 'Search and select products...',
            maxOptions: 1000
        });
    </script>
</div>
@endsection
