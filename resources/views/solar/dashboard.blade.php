@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <div class="m-6">
        <x-back-button url="{{ route('dashboard') }}" label="🏠 Go to Dashboard" />
    </div>
    <div class="mb-10">
        <div class="relative h-56 rounded-2xl overflow-hidden shadow-md">
            <img src="https://images.unsplash.com/photo-1576068205458-845521b0c0c4?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NDJ8fHNvbGFyfGVufDB8fDB8fHww" alt="Solar Installation" class="object-cover w-full h-full">
            <div class="absolute inset-0 bg-black/30 flex items-center justify-center">
                <h1 class="text-white text-3xl font-semibold">☀️ Solar Dashboard</h1>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <a href="{{ route('solar_contracts.index') }}" class="bg-white hover:bg-yellow-50 transition shadow rounded-xl p-5">
            <h2 class="text-xl font-medium text-gray-800">📄 Installations</h2>
            <p class="text-sm text-gray-500 mt-1">Oversee solar setup and planning workflows.</p>
        </a>
        <a href="{{ route('solar_products.index') }}" class="bg-white hover:bg-yellow-50 transition shadow rounded-xl p-5">
            <h2 class="text-xl font-medium text-gray-800">📦 Inventory</h2>
            <p class="text-sm text-gray-500 mt-1">Manage solar panels, batteries, and hardware.</p>
        </a>
        <a href="" class="bg-white hover:bg-yellow-50 transition shadow rounded-xl p-5">
            <h2 class="text-xl font-medium text-gray-800">🛠 Quote Generator</h2>
            <p class="text-sm text-gray-500 mt-1">Log faults or hardware issues.</p>
        </a>
        <a href="" class="bg-white hover:bg-yellow-50 transition shadow rounded-xl p-5">
            <h2 class="text-xl font-medium text-gray-800">👷 Installers</h2>
            <p class="text-sm text-gray-500 mt-1">Assign certified solar teams to projects.</p>
        </a>
        <a href="" class="bg-white hover:bg-yellow-50 transition shadow rounded-xl p-5">
            <h2 class="text-xl font-medium text-gray-800">🔋 Performance Logs</h2>
            <p class="text-sm text-gray-500 mt-1">Track daily output and battery stats.</p>
        </a>
    </div>
</div>
@endsection
