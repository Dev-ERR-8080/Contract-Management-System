@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10 px-4">
    <h2 class="text-2xl font-semibold mb-6 text-gray-800">Edit Electricity Contract</h2>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <strong class="font-bold">Whoops!</strong>
            <p>There were some problems with your input:</p>
            <ul class="list-disc list-inside mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('electricity_contracts.update', $contract->_id) }}" method="POST" class="space-y-5 bg-white p-6 rounded-lg shadow-md">
        @csrf
        @method('PUT')

        <div>
            <label for="customer_name" class="block text-sm font-medium text-gray-700">Customer Name</label>
            <input type="text" name="customer_name" value="{{ old('customer_name', $contract->customer_name) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
        </div>

        <div>
            <label for="customer_address" class="block text-sm font-medium text-gray-700">Customer Address</label>
            <input type="text" name="customer_address" value="{{ old('customer_address', $contract->customer_address) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div>
            <label for="contact_number" class="block text-sm font-medium text-gray-700">Contact Number</label>
            <input type="text" name="contact_number" value="{{ old('contact_number', $contract->contact_number) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div>
            <label for="customer_email" class="block text-sm font-medium text-gray-700">Customer Email</label>
            <input type="email" name="customer_email" value="{{ old('customer_email', $contract->customer_email) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <div>
            <label for="installation_type" class="block text-sm font-medium text-gray-700">Installation Type</label>
            <input type="text" name="installation_type" value="{{ old('installation_type', $contract->installation_type) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div>
            <label for="installation_date" class="block text-sm font-medium text-gray-700">Installation Date</label>
            <input type="date" name="installation_date" value="{{ old('installation_date', $contract->installation_date ? \Carbon\Carbon::parse($contract->installation_date)->format('Y-m-d') : '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div>
            <label for="contract_start_date" class="block text-sm font-medium text-gray-700">Contract Start Date</label>
            <input type="date" name="contract_start_date" value="{{ old('contract_start_date', $contract->contract_start_date ? \Carbon\Carbon::parse($contract->contract_start_date)->format('Y-m-d') : '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div>
            <label for="contract_end_date" class="block text-sm font-medium text-gray-700">Contract End Date</label>
            <input type="date" name="contract_end_date" value="{{ old('contract_end_date', $contract->contract_end_date ? \Carbon\Carbon::parse($contract->contract_end_date)->format('Y-m-d') : '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div>
            <label for="contract_amount" class="block text-sm font-medium text-gray-700">Contract Amount</label>
            <input type="number" step="0.01" name="contract_amount" value="{{ old('contract_amount', $contract->contract_amount) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div>
            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
            <select name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                <option value="Active" {{ old('status', $contract->status) == 'Active' ? 'selected' : '' }}>Active</option>
                <option value="Pending" {{ old('status', $contract->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Expired" {{ old('status', $contract->status) == 'Expired' ? 'selected' : '' }}>Expired</option>
            </select>
        </div>

        <div>
            <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
            <textarea name="notes" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('notes', $contract->notes) }}</textarea>
        </div>

        <div class="flex space-x-3 pt-4">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded shadow">Update</button>
            <a href="{{ route('electricity_contracts.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded shadow">Cancel</a>
        </div>
    </form>
</div>
@endsection
