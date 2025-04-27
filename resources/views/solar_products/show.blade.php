{{-- resources/views/solar_products/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white p-8 shadow-lg rounded-lg">
        <h1 class="text-3xl font-semibold text-gray-900 mb-4">{{ $product->name }}</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Product Brand -->
            <div>
                <h3 class="text-lg font-semibold text-gray-700">Brand</h3>
                <p class="text-gray-500">{{ $product->brand }}</p>
            </div>

            <!-- Product Wattage -->
            <div>
                <h3 class="text-lg font-semibold text-gray-700">Wattage</h3>
                <p class="text-gray-500">{{ $product->wattage }}W</p>
            </div>

            <!-- Product Price -->
            <div>
                <h3 class="text-lg font-semibold text-gray-700">Price</h3>
                <p class="text-gray-500">₹{{ number_format($product->price, 2) }}</p>
            </div>

            <!-- Product Stock -->
            <div>
                <h3 class="text-lg font-semibold text-gray-700">Stock Quantity</h3>
                <p class="text-gray-500">{{ $product->stock }}</p>
            </div>

            <!-- Product Description -->
            <div class="col-span-2">
                <h3 class="text-lg font-semibold text-gray-700">Description</h3>
                <p class="text-gray-500">{{ $product->description }}</p>
            </div>
        </div>

        <div class="mt-8 text-right">
            <a href="{{ route('solar_products.edit', $product->id) }}" class="bg-blue-600 text-white text-sm px-6 py-3 rounded-md hover:bg-blue-700 transition">Edit Product</a>
        </div>
    </div>
</div>
@endsection
