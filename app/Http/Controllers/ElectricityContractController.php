<?php

namespace App\Http\Controllers;

use App\Models\ElectricityContract;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage; // If you want template file uploads

class ElectricityContractController extends Controller
{
    /**
     * Display a listing of electricity_contracts with search and filtering.
     */
    public function index(Request $request)
    {
        $query = ElectricityContract::query();

        // Search Filters
        if ($request->filled('customer_name')) {
            $query->where('customer_name', 'like', '%' . $request->customer_name . '%');
        }

        if ($request->filled('contract_id')) {
            $query->where('contract_id', $request->contract_id);
        }

        if ($request->filled('installation_date')) {
            $query->whereDate('installation_date', $request->installation_date);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $contracts = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('electricity_contracts.index', compact('contracts'));
    }

    /**
     * Show the form for creating a new contract.
     */
    public function create()
    {
        return view('electricity_contracts.create');
    }

    /**
     * Store a newly created contract.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_address' => 'required|string|max:500',
            'contact_number' => 'required|string|max:20',
            'customer_email' => 'nullable|email|max:255',
            'installation_type' => 'required|string|max:100',
            'installation_date' => 'required|date',
            'contract_start_date' => 'required|date',
            'contract_end_date' => 'required|date',
            'tariff_plan' => 'nullable|string|max:100',
            'meter_number' => 'nullable|string|max:100',
            'initial_reading' => 'nullable|numeric',
            'contract_amount' => 'required|numeric',
            'payment_terms' => 'nullable|string|max:255',
            'payment_status' => 'nullable|string|max:50',
            'last_payment_date' => 'nullable|date',
            'next_billing_date' => 'nullable|date',
            'service_location_coordinates' => 'nullable|string|max:255',
            'power_capacity_kw' => 'nullable|numeric',
            'voltage_level' => 'nullable|string|max:100',
            'supply_type' => 'nullable|string|max:100',
            'billing_cycle' => 'nullable|string|max:50',
            'terms_and_conditions' => 'nullable|string',
            'notes' => 'nullable|string',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        $validatedData['contract_id'] = $this->generateContractId();
        $validatedData['contract_duration'] = Carbon::parse($validatedData['contract_start_date'])
            ->diffInMonths(Carbon::parse($validatedData['contract_end_date']));
        $validatedData['created_by'] = Auth::id();
        $validatedData['updated_by'] = Auth::id();

        CustomerContract::create($validatedData);

        return redirect()->route('customer-contracts.index')
            ->with('success', 'Customer contract created successfully.');
    }

    /**
     * Show a specific contract.
     */
    public function show($id)
    {
        $contract = ElectricityContract::findOrFail($id);
        return view('electricity_contracts.show', compact('contract'));
    }

    /**
     * Edit contract.
     */
    public function edit($id)
    {
        $contract = ElectricityContract::findOrFail($id);
        return view('electricity_contracts.edit', compact('contract'));
    }

    /**
     * Update contract details.
     */
    public function update(Request $request, CustomerContract $customerContract)
    {
        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_address' => 'required|string|max:500',
            'contact_number' => 'required|string|max:20',
            'customer_email' => 'nullable|email|max:255',
            'installation_type' => 'required|string|max:100',
            'installation_date' => 'required|date',
            'contract_start_date' => 'required|date',
            'contract_end_date' => 'required|date',
            'tariff_plan' => 'nullable|string|max:100',
            'meter_number' => 'nullable|string|max:100',
            'initial_reading' => 'nullable|numeric',
            'contract_amount' => 'required|numeric',
            'payment_terms' => 'nullable|string|max:255',
            'payment_status' => 'nullable|string|max:50',
            'last_payment_date' => 'nullable|date',
            'next_billing_date' => 'nullable|date',
            'service_location_coordinates' => 'nullable|string|max:255',
            'power_capacity_kw' => 'nullable|numeric',
            'voltage_level' => 'nullable|string|max:100',
            'supply_type' => 'nullable|string|max:100',
            'billing_cycle' => 'nullable|string|max:50',
            'terms_and_conditions' => 'nullable|string',
            'notes' => 'nullable|string',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        $validatedData['contract_duration'] = Carbon::parse($validatedData['contract_start_date'])
            ->diffInMonths(Carbon::parse($validatedData['contract_end_date']));
        $validatedData['updated_by'] = Auth::id();

        $customerContract->update($validatedData);

        return redirect()->route('customer-contracts.index')
            ->with('success', 'Customer contract updated successfully.');
    }

    /**
     * Delete a contract.
     */
    public function destroy($id)
    {
        $contract = ElectricityContract::findOrFail($id);
        $contract->delete();

        return redirect()->route('electricity_contracts.index')->with('success', 'Contract deleted successfully.');
    }

    /**
     * Generate unique, sequential contract IDs automatically.
     */
    private function generateContractId()
    {
        $latest = ElectricityContract::orderBy('created_at', 'desc')->first();
        $number = 1;

        if ($latest && $latest->contract_id) {
            $number = intval(substr($latest->contract_id, 3)) + 1;
        }

        return 'CON' . str_pad($number, 6, '0', STR_PAD_LEFT); // Example: CON000001
    }

    /**
     * Generate invoice for a contract (Stub: expand later)
     */
    public function generateInvoice($id)
    {
        $contract = ElectricityContract::findOrFail($id);

        // Here you can build PDF or view-based invoice
        // Example: return PDF::loadView('invoice', compact('contract'))->download('invoice.pdf');

        return view('electricity_contracts.invoice', compact('contract'));
    }

    /**
     * Send payment reminder email (Stub: expand later)
     */
    public function sendPaymentReminder($id)
    {
        $contract = ElectricityContract::findOrFail($id);

        // Send email logic here
        // Mail::to($contract->customer_email)->send(new PaymentReminder($contract));

        return back()->with('success', 'Payment reminder sent successfully.');
    }

    /**
     * Contract versioning (basic idea — not fully implemented)
     */
    public function versionHistory($id)
    {
        // Optional: If you implement versioning, fetch previous versions
        // For now, just show that feature is "coming soon"
        return view('electricity_contracts.version-history', ['message' => 'Versioning coming soon.']);
    }
}
