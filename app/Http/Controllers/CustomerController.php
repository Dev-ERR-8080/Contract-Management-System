<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'pincode' => 'required|string',
            'aadhaar_number' => 'nullable|string',
            'pan_number' => 'nullable|string',
            'connection_type' => 'required|string',
            'supply_type' => 'required|string',
            'meter_number' => 'nullable|string',
            'consumer_number' => 'nullable|string',
            'installation_date' => 'nullable|date',
        ]);

        Customer::create($data);

        return redirect()->route('customers.index')->with('success', 'Customer added successfully');
    }

    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'pincode' => 'required|string',
            'aadhaar_number' => 'nullable|string',
            'pan_number' => 'nullable|string',
            'connection_type' => 'required|string',
            'supply_type' => 'required|string',
            'meter_number' => 'nullable|string',
            'consumer_number' => 'nullable|string',
            'installation_date' => 'nullable|date',
        ]);

        $customer->update($data);

        return redirect()->route('customers.index')->with('success', 'Customer updated successfully');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully');
    }
}
