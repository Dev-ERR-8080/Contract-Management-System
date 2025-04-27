@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-8">
    <h2 class="text-2xl font-semibold mb-6 text-gray-800">📂 Quotes Grouped by Contract</h2>

    @forelse ($quotes as $contractId => $groupedQuotes)
        @php
            $contract = $contracts[$contractId] ?? null;
        @endphp

        <div class="bg-white shadow-md rounded-lg p-6 mb-8">
            <h3 class="text-xl font-semibold text-blue-700 mb-4">
                {{ $contract ? $contract->customer_name : 'Unknown Contract' }} 
                <span class="text-sm text-gray-500">(Contract ID: {{ $contractId }})</span>
            </h3>

            <table class="w-full table-auto border-collapse text-left">
                <thead>
                    <tr class="bg-gray-100 text-sm text-gray-600">
                        <th class="py-2 px-3">Type</th>
                        <th class="py-2 px-3">Amount (₹)</th>
                        <th class="py-2 px-3">Details</th>
                        <th class="py-2 px-3">Created</th>
                        <th class="py-2 px-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($groupedQuotes as $quote)
                        <tr class="border-t">
                            <td class="py-2 px-3">{{ ucfirst($quote->type) }}</td>
                            <td class="py-2 px-3">₹{{ number_format($quote->amount, 2) }}</td>
                            <td class="py-2 px-3 whitespace-pre-line text-sm text-gray-700">
                                @if(is_array($quote->details))
                                    <ul class="list-disc pl-5 space-y-1">
                                        @foreach($quote->details as $key => $value)
                                            <li><strong>{{ ucfirst($key) }}:</strong> {{ $value }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    {{ $quote->details }}
                                @endif
                            </td>

                            <td class="py-2 px-3 text-sm text-gray-500">{{ $quote->created_at->format('Y-m-d') }}</td>
                            <td class="py-2 px-3 text-sm text-gray-500"><a href="{{ route('solar_contracts.show', $contract->_id) }}" class="ml-2 text-green-600 hover:underline">View Contract</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @empty
        <p class="text-gray-600">No quotes found.</p>
    @endforelse
</div>
@endsection
