<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SolarProduct;
use Storage;

class SolarProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = SolarProduct::query();
        //search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%$search%")
                  ->orWhere('category', 'like', "%$search%");
        }
        // Sorting logic
        if ($request->filled('sort')) {
            switch ($request->input('sort')) {
                case 'name_asc':
                    $query->orderBy('name');
                    break;
                case 'name_desc':
                    $query->orderByDesc('name');
                    break;
                case 'price_asc':
                    $query->orderBy('price');
                    break;
                case 'price_desc':
                    $query->orderByDesc('price');
                    break;
            }
        } else {
            $query->latest(); // Default sorting
        }

        
        $products = $query->paginate(10)->withQueryString();

        return view('solar_products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('solar_products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        \Log::info('Incoming request', $request->all());
        $validated = $request->validate([
            'name' => 'required|unique:solar_products,name',
            'brand' => 'required|string',
            'wattage' => 'required|numeric',
            'stock' => 'required|numeric',
            'description' => 'required',
            'price' => 'required|numeric',
            'category' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);
        
        \Log::info('Validated data', $validated);
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('solar_images', 'public');
        }

        $product = SolarProduct::create([
            ...$validated,
            'image_path' => $imagePath,
        ]);

        \Log::info('Product created', $product->toArray());

        return redirect()->route('solar_products.index')->with('success', 'Product Created Successfully!');
    }

    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = SolarProduct::findOrFail($id);
        return view('solar_products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = SolarProduct::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'brand' => 'required|string',
            'wattage' => 'required|numeric',
            'stock' => 'required|numeric',
            'description' => 'required',
            'price' => 'required|numeric',
            'category' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);
        
        if ($request->hasFile('image')) {
            if ($product->image_path) {
                Storage::disk('public')->delete($product->image_path);
            }
            $product->image_path = $request->file('image')->store('solar_images', 'public');
        }
        
        // Update all fields
        $product->name = $request->name;
        $product->brand = $request->brand;
        $product->wattage = $request->wattage;
        $product->stock = $request->stock;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category = $request->category;
        $product->save();
        

        return redirect()->route('solar_products.index')->with('success', 'Product Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = SolarProduct::findOrFail($id);
        if ($product->image_path) Storage::disk('public')->delete($product->image_path);
        $product->delete();
        return redirect()->route('solar_products.index')->with('success', 'Product Deleted');
    }
}
