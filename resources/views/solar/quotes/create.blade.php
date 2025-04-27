@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">
    <h2 class="text-2xl font-semibold mb-6 text-gray-800">
        🧾 Create Quote for {{ $contract->customer_name }}
    </h2>

    @if ($errors->any())
        <div class="mb-4 bg-red-100 text-red-700 p-4 rounded">
            <ul class="list-disc pl-6">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('solar.quotes.store', $contract->_id) }}">
        @csrf

        <!-- Quote Type -->
        <div class="mb-4">
            <label for="type" class="block text-sm font-medium text-gray-700">Quote Type</label>
            <select name="type" id="quote-type" required
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                <option value="">-- Select --</option>
                <option value="initial">Initial Estimate</option>
                <option value="final">Final Quote</option>
            </select>
        </div>

        <!-- Shared Field: Amount -->
        <div id="amount-section" class="mb-4 hidden">
            <label for="amount" class="block text-sm font-medium text-gray-700">Budget (₹)</label>
            <input type="number" name="amount" id="amount" step="0.01"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Initial Estimate Fields -->
        <div id="initial-fields" class="hidden">
            <!-- <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Products Used</label>
                <input type="text" name="details[products]" placeholder="E.g. 4x 350W Panels, 5kW Inverter"
                    class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div> -->
            <div class="md:col-span-2">
                <label for="product_ids" class="block text-sm font-medium text-gray-700">Select Products</label>
                <select name="product_ids[]" id="product_ids" multiple class="mt-1 block w-full border px-4 py-2 rounded-md">
                    @foreach($products as $product)
                        <option value="{{ $product->_id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Installation Area</label>
                <input type="text" name="details[area]" placeholder="E.g. Rooftop, 200 sq.ft"
                    class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Additional Notes</label>
                <textarea name="details[notes]" rows="3"
                    class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Optional comments or considerations..."></textarea>
            </div>
        </div>

        <!-- Final Quote Fields -->
        <div id="final-fields" class="hidden">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Quote Details / Final Terms</label>
                <textarea name="details[final_terms]" rows="4"
                    class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Include final system configuration, cost breakdown, terms, etc."></textarea>
            </div>
        </div>

        <!-- Submit -->
        <div class="flex justify-between items-center mt-6">
            <a href="{{ route('solar_contracts.show', $contract->_id) }}"
                class="text-blue-600 hover:underline text-sm">&larr; Back to Contract</a>

            <button type="submit"
                class="bg-blue-600 text-white px-6 py-2 rounded-md shadow-md hover:bg-blue-700 transition">
                Save Quote
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const typeSelect = document.getElementById('quote-type');
        const amountSection = document.getElementById('amount-section');
        const initialFields = document.getElementById('initial-fields');
        const finalFields = document.getElementById('final-fields');

        typeSelect.addEventListener('change', function () {
            const selected = this.value;
            amountSection.classList.toggle('hidden', !selected);
            initialFields.classList.toggle('hidden', selected !== 'initial');
            finalFields.classList.toggle('hidden', selected !== 'final');
        });
    });
    new TomSelect('#product_ids', {
            plugins: ['remove_button'],
            placeholder: 'Search and select products...',
            maxOptions: 1000
        });
</script>
    
@endsection
