@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 bg-white shadow rounded-lg mt-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Solar Contract Details</h1>

    <div class="space-y-4 text-gray-700">
        <div><strong>Customer Name:</strong> {{ $contract->customer_name }}</div>
        <div><strong>Site Address:</strong> {{ $contract->site_address }}</div>

        <div>
            <strong>Product IDs:</strong>
            @if(is_array($contract->product_ids))
                <ul class="list-disc pl-5">
                    @foreach($contract->product_ids as $id)
                        <li>{{ $id }}</li>
                    @endforeach
                </ul>
            @else
                <span>{{ $contract->product_ids }}</span>
            @endif
        </div>

        <div><strong>Total Cost:</strong> ₹{{ number_format($contract->total_cost, 2) }}</div>
        <div><strong>Installation Date:</strong> {{ $contract->installation_date?->format('d-m-Y') ?? 'N/A' }}</div>
        <div><strong>Status:</strong> {{ ucfirst($contract->status) }}</div>
        <div><strong>Assigned To:</strong> {{ $contract->assigned_to ?? 'Unassigned' }}</div>
        <div><strong>Notes:</strong> {!! nl2br(e($contract->notes ?? 'None')) !!}</div>

        <div>
            <strong>Progress Updates:</strong>
            @if(is_array($contract->progress_updates) && count($contract->progress_updates))
                <ul class="list-disc pl-5">
                    @foreach($contract->progress_updates as $update)
                        <li>{{ $update }}</li>
                    @endforeach
                </ul>
            @else
                <span>No updates yet.</span>
            @endif
        </div>
    </div>

    <div class="mt-8">
        <a href="{{ route('solar_contracts.index') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">← Back to Contracts</a>
    </div>
</div>
@endsection
