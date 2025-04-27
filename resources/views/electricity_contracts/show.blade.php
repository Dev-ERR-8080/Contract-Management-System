@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Contract Details</h1>

    <a href="{{ route('customer-contracts.index') }}" class="btn btn-secondary mb-3">Back to List</a>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $customerContract->customer_name }}</h5>

            <div class="row mb-2">
                <div class="col-md-6">
                    <strong>Contract ID:</strong> {{ $customerContract->contract_id }}
                </div>
                <div class="col-md-6">
                    <strong>Contact Number:</strong> {{ $customerContract->contact_number }}
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-6">
                    <strong>Email Address:</strong> {{ $customerContract->email_address }}
                </div>
                <div class="col-md-6">
                    <strong>Address:</strong> {{ $customerContract->address }}
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-6">
                    <strong>Installation Type:</strong> {{ $customerContract->installation_type }}
                </div>
                <div class="col-md-6">
                    <strong>Installation Date:</strong> {{ $customerContract->installation_date }}
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-6">
                    <strong>Meter Number:</strong> {{ $customerContract->meter_number }}
                </div>
                <div class="col-md-6">
                    <strong>Contract Amount:</strong> {{ $customerContract->contract_amount }}
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-6">
                    <strong>Payment Status:</strong> {{ $customerContract->payment_status ?? 'N/A' }}
                </div>
                <div class="col-md-6">
                    <strong>Assigned To:</strong> {{ $customerContract->assignedTo->name ?? 'Not Assigned' }}
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-12">
                    <strong>Additional Notes:</strong><br>
                    {{ $customerContract->additional_notes }}
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
