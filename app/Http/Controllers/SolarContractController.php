<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SolarContract;
use App\Models\SolarProduct;

class SolarContractController extends Controller
{
    public function index(Request $request)
    {
        $query = SolarContract::query();

        // Search by customer name or site address
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('customer_name', 'like', '%' . $searchTerm . '%')
                ->orWhere('site_address', 'like', '%' . $searchTerm . '%');
            });
        }

        // Filter by status if provided
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Order by latest and paginate
        $contracts = $query->latest()->paginate(10);

        return view('solar_contracts.index', compact('contracts'));
    }


    public function create()
    {
        $products = SolarProduct::all();
        return view('solar_contracts.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'site_address' => 'required|string|max:255',
            'total_cost' => 'required|numeric',
            'installation_date' => 'required|date',
            'product_ids' => 'nullable|array',
            'product_ids.*' => 'string',
            'status' => 'required|string',
            'assigned_to' => 'nullable|string',
            'notes' => 'nullable|string',
            'progress_updates' => 'nullable|array',
            'progress_updates.*' => 'nullable|string',
        ]); 

        SolarContract::create($validated);

        return redirect()->route('solar_contracts.index')->with('success', 'Contract created successfully!');
    }

    public function edit($id)
    {
        $contract = SolarContract::findOrFail($id);
        $products = SolarProduct::all();
        return view('solar_contracts.edit', compact('contract', 'products'));
    }

    public function update(Request $request, $id)
{
    $contract = SolarContract::findOrFail($id);

    $validated = $request->validate([
        'customer_name' => 'required|string|max:255',
        'site_address' => 'required|string',
        'product_ids' => 'required|array',
        'total_cost' => 'required|numeric',
        'installation_date' => 'required|date',
        'status' => 'required|string',
        'assigned_to' => 'nullable|string',
        'notes' => 'nullable|string',
        'progress_updates' => 'nullable|array',
    ]);

    $contract->update($validated);

    return redirect()->route('solar_contracts.index')->with('success', 'Contract updated successfully!');
    }


    public function destroy($id)
    {
        SolarContract::findOrFail($id)->delete();
        return redirect()->route('solar_contracts.index')->with('success', 'Contract deleted.');
    }

    public function show($id)
    {
        $contract = SolarContract::findOrFail($id);
        return view('solar_contracts.show', compact('contract'));
    }

    public function installationDates()
    {
        $contracts = \App\Models\SolarContract::whereNotNull('installation_date')
                    ->get(['installation_date', 'customer_name', '_id']);

        return response()->json($contracts);
    }

}
