{{-- resources/views/solar_products/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-semibold text-gray-900 mb-6">Edit Solar Product</h1>

    <div class="bg-white p-8 shadow-lg rounded-lg">
        <form action="{{ route('solar_products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Product Name -->
                <div>
                    <label for="name" class="block text-gray-700 text-sm font-medium mb-2">Product Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Solar Panel Model X" required>
                    @error('name')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Brand -->
                <div>
                    <label for="brand" class="block text-gray-700 text-sm font-medium mb-2">Brand</label>
                    <input type="text" id="brand" name="brand" value="{{ old('brand', $product->brand) }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Brand X" required>
                    @error('brand')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Wattage -->
                <div>
                    <label for="wattage" class="block text-gray-700 text-sm font-medium mb-2">Wattage</label>
                    <input type="number" id="wattage" name="wattage" value="{{ old('wattage', $product->wattage) }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="200" required>
                    @error('wattage')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Price -->
                <div>
                    <label for="price" class="block text-gray-700 text-sm font-medium mb-2">Price (₹)</label>
                    <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="₹ 10000" required>
                    @error('price')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Stock Quantity -->
                <div>
                    <label for="stock" class="block text-gray-700 text-sm font-medium mb-2">Stock Quantity</label>
                    <input type="number" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="10" required>
                    @error('stock')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Category -->
                <div>
                    <label for="category" class="block text-gray-700 text-sm font-medium mb-2">Category</label>
                    <select id="category" name="category" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">-- Select Category --</option>
                        <option value="Panel" {{ old('category', $product->category) == 'Panel' ? 'selected' : '' }}>Panel</option>
                        <option value="Inverter" {{ old('category', $product->category) == 'Inverter' ? 'selected' : '' }}>Inverter</option>
                        <option value="Battery" {{ old('category', $product->category) == 'Battery' ? 'selected' : '' }}>Battery</option>
                        <option value="Accessory" {{ old('category', $product->category) == 'Accessory' ? 'selected' : '' }}>Accessory</option>
                    </select>
                    @error('category')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Description -->
                <div class="col-span-2">
                    <label for="description" class="block text-gray-700 text-sm font-medium mb-2">Description</label>
                    <textarea id="description" name="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Brief description of the solar product...">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mt-8 text-right">
                <button type="submit" class="bg-blue-600 text-white text-sm px-6 py-3 rounded-md hover:bg-blue-700 transition">Update Product</button>
            </div>
        </form>
    </div>
</div>
@endsection
