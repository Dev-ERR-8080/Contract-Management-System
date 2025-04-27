@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-2xl font-semibold mb-4 text-gray-800">🧾 Quote Details</h2>

        <div class="mb-6">
            <h3 class="text-lg font-medium text-gray-700">Customer Info</h3>
            <p><span class="font-semibold">Name:</span> {{ $contract->customer_name }}</p>
            <p><span class="font-semibold">Site Address:</span> {{ $contract->site_address }}</p>
        </div>

        <div class="mb-6">
            <h3 class="text-lg font-medium text-gray-700">Quote Info</h3>
            <p><span class="font-semibold">Type:</span> {{ ucfirst($quote->type) }} Quote</p>
            <p><span class="font-semibold">Amount:</span> ₹{{ number_format($quote->amount, 2) }}</p>
            <p><span class="font-semibold">Details:</span> {{ $quote->details ?? 'N/A' }}</p>
            <p><span class="font-semibold">Created At:</span> {{ $quote->created_at->format('d M Y, h:i A') }}</p>
        </div>

        <div class="flex gap-4">
            @if($quote->pdf_path)
                <a href="{{ asset('storage/' . $quote->pdf_path) }}" target="_blank"
                   class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    View PDF
                </a>
            @endif

            @if($quote->docx_path)
                <a href="{{ asset('storage/' . $quote->docx_path) }}" download
                   class="inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                    Download Word
                </a>
            @endif

            <a href="{{ route('solar_contracts.show', $contract->_id) }}"
               class="ml-auto text-sm text-gray-600 hover:underline">
                ← Back to Contract
            </a>
        </div>
    </div>
</div>
@endsection
