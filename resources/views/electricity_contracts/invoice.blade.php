@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Invoice</h2>

    <div class="card p-4">
        <h4>Electricity Service Invoice</h4>
        <hr>

        <p><strong>Invoice Number:</strong> INV-{{ $contract->contract_id }}</p>
        <p><strong>Customer Name:</strong> {{ $contract->customer_name }}</p>
        <p><strong>Address:</strong> {{ $contract->customer_address }}</p>
        <p><strong>Installation Type:</strong> {{ $contract->installation_type }}</p>
        <p><strong>Contract Amount:</strong> ₹{{ number_format($contract->contract_amount, 2) }}</p>
        <p><strong>Due Date:</strong> {{ $contract->next_billing_date?->format('d-m-Y') }}</p>

        <hr>

        <p><strong>Notes:</strong> {{ $contract->notes }}</p>

        <p class="mt-4">Thank you for choosing our service!</p>
    </div>

    <a href="{{ route('contracts.index') }}" class="btn btn-primary mt-4">Back</a>
</div>
@endsection
