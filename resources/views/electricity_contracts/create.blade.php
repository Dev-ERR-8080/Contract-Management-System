<x-app-layout>

@section('content')
<div class="max-w-5xl mx-auto py-8">
    <h2 class="text-2xl font-bold mb-6 text-center">Create New Electricity Contract</h2>

    <form action="{{ route('electricity_contracts.store') }}" method="POST" class="space-y-6 bg-white p-8 rounded shadow-md">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block font-semibold mb-1">Customer Name</label>
                <input type="text" name="customer_name" class="w-full border rounded p-2" required>
            </div>

            <div>
                <label class="block font-semibold mb-1">Customer Email</label>
                <input type="email" name="customer_email" class="w-full border rounded p-2">
            </div>

            <div>
                <label class="block font-semibold mb-1">Customer Address</label>
                <input type="text" name="customer_address" class="w-full border rounded p-2" required>
            </div>

            <div>
                <label class="block font-semibold mb-1">Contact Number</label>
                <input type="text" name="contact_number" class="w-full border rounded p-2" required>
            </div>

            <div>
                <label class="block font-semibold mb-1">Installation Type</label>
                <input type="text" name="installation_type" class="w-full border rounded p-2" required>
            </div>

            <div>
                <label class="block font-semibold mb-1">Installation Date</label>
                <input type="date" name="installation_date" class="w-full border rounded p-2" required>
            </div>

            <div>
                <label class="block font-semibold mb-1">Tariff Plan</label>
                <input type="text" name="tariff_plan" class="w-full border rounded p-2">
            </div>

            <div>
                <label class="block font-semibold mb-1">Contract Amount</label>
                <input type="number" step="0.01" name="contract_amount" class="w-full border rounded p-2" required>
            </div>

            <div>
                <label class="block font-semibold mb-1">Contract Start Date</label>
                <input type="date" name="contract_start_date" value="{{ old('contract_start_date') }}" class="w-full border rounded p-2" required>
            </div>

            <div>
                <label class="block font-semibold mb-1">Contract End Date</label>
                <input type="date" name="contract_end_date" class="w-full border rounded p-2" required>
            </div>

            <div>
                <label class="block font-semibold mb-1">Payment Terms</label>
                <input type="text" name="payment_terms" class="w-full border rounded p-2">
            </div>

            <div>
                <label class="block font-semibold mb-1">Payment Status</label>
                <select name="payment_status" class="w-full border rounded p-2">
                    <option value="">Select Status</option>
                    <option value="Paid">Paid</option>
                    <option value="Pending">Pending</option>
                    <option value="Overdue">Overdue</option>
                </select>
            </div>

            <div>
                <label class="block font-semibold mb-1">Last Payment Date</label>
                <input type="date" name="last_payment_date" class="w-full border rounded p-2">
            </div>

            <div>
                <label class="block font-semibold mb-1">Next Billing Date</label>
                <input type="date" name="next_billing_date" class="w-full border rounded p-2">
            </div>

            <div>
                <label class="block font-semibold mb-1">Meter Number</label>
                <input type="text" name="meter_number" class="w-full border rounded p-2">
            </div>

            <div>
                <label class="block font-semibold mb-1">Initial Reading</label>
                <input type="number" name="initial_reading" class="w-full border rounded p-2">
            </div>

            <div>
                    <label class="block font-semibold mb-1">Service Location Coordinates (lat,lng)</label>
                    <input type="text" name="service_location_coordinates" class="w-full border rounded p-2" placeholder="e.g. 28.61,77.23">
            </div>

            <div>
                <label class="block font-semibold mb-1">Power Capacity (kW)</label>
                <input type="number" step="0.01" name="power_capacity_kw" class="w-full border rounded p-2">
            </div>

            <div>
                <label class="block font-semibold mb-1">Voltage Level</label>
                <input type="text" name="voltage_level" class="w-full border rounded p-2">
            </div>

            <div>
                <label class="block font-semibold mb-1">Supply Type</label>
                <select name="supply_type" class="w-full border rounded p-2">
                    <option value="">Select Supply Type</option>
                    <option value="Single-phase">Single-phase</option>
                    <option value="Three-phase">Three-phase</option>
                </select>
            </div>

            <div>
                <label class="block font-semibold mb-1">Billing Cycle</label>
                <select name="billing_cycle" class="w-full border rounded p-2">
                    <option value="">Select Billing Cycle</option>
                    <option value="Monthly">Monthly</option>
                    <option value="Quarterly">Quarterly</option>
                    <option value="Annually">Annually</option>
                </select>
            </div>

            <div class="md:col-span-2">
                <label class="block font-semibold mb-1">Terms and Conditions</label>
                <textarea name="terms_and_conditions" class="w-full border rounded p-2" rows="3"></textarea>
            </div>

            <div class="md:col-span-2">
                <label class="block font-semibold mb-1">Notes</label>
                <textarea name="notes" class="w-full border rounded p-2" rows="3"></textarea>
            </div>

            <div>
                <label class="block font-semibold mb-1">Assigned To</label>
                <input type="text" name="assigned_to" class="w-full border rounded p-2">
            </div>
        </div>

        <div class="mt-8 flex justify-center">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                Create Contract
            </button>
        </div>
    </form>
</div>
@endsection
</x-app-layout>