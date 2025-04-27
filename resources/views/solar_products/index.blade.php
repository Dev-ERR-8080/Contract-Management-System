{{-- resources/views/solar_products/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
  
    @if(session('success'))
    <!-- sucess token -->
    
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false
        });
    </script>
    @endif
    
    <div>
    <x-back-button url="{{ route('solar.dashboard') }}" label="🏠 Go to Solar Dashboard" />

    </div>

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-semibold text-gray-900">🌞 Solar Products</h1>
        <a href="{{ route('solar_products.create') }}" class="inline-block bg-blue-600 text-white text-sm px-6 py-3 rounded-md hover:bg-blue-700 shadow-md transition">+ Add Product</a>
    </div>

    <div class="mb-8">
        <form method="GET" action="{{ route('solar_products.index') }}" class="flex justify-between items-center space-x-4">
            <input type="text" name="search" placeholder="Search by name or brand" class="border-2 border-gray-300 rounded-full px-6 py-2 w-full sm:w-1/2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </form>
    </div>
    <div>
    <form method="GET" action="{{ route('solar_products.index') }}" class="mb-6 flex flex-col md:flex-row gap-4 items-center">
    {{-- Preserve the search term if already applied --}}
        <input type="hidden" name="search" value="{{ request('search') }}">

        <label for="sort" class="text-sm text-gray-700">Sort By:</label>
        <select name="sort" id="sort" onchange="this.form.submit()" class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">-- Default --</option>
            <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name (A-Z)</option>
            <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name (Z-A)</option>
            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price (Low to High)</option>
            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price (High to Low)</option>
        </select>
    </form>

    </div>
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Brand</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Wattage</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($products as $product)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $product->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $product->brand }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $product->wattage }} W</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">₹{{ number_format($product->price, 2) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $product->stock }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('solar_products.edit', $product->_id) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form method="POST" action="{{ route('solar_products.destroy', $product->_id) }}" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-6">
    {{ $products->appends(request()->query())->links('pagination::tailwind') }}
    </div>
    @section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
            @endif
          document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This action can't be undone.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
    </script>      
    @endsection
</div>
@endsection
