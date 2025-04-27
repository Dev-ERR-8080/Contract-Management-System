
@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
<div class="m-6">
        <x-back-button url="{{ route('dashboard') }}" label="🏠 Go to Dashboard" />
    </div>
    <div class="mb-10">
        <div class="relative h-56 rounded-2xl overflow-hidden shadow-md">
            <img src="https://images.unsplash.com/photo-1635952281433-33568cb65853?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Electric Grid" class="object-cover w-full h-full">
            <div class="absolute inset-0 bg-black/30 flex items-center justify-center">
                <h1 class="text-white text-3xl font-semibold">🔌 Electricity Dashboard</h1>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <a href="{{ route('electricity_contracts.index') }}" class="bg-white hover:bg-blue-50 transition shadow rounded-xl p-5">
            <h2 class="text-xl font-medium text-gray-800">📄 Contracts</h2>
            <p class="text-sm text-gray-500 mt-1">Manage energy supply and service agreements.</p>
        </a>
        <a href="" class="bg-white hover:bg-blue-50 transition shadow rounded-xl p-5">
            <h2 class="text-xl font-medium text-gray-800">📦 Inventory</h2>
            <p class="text-sm text-gray-500 mt-1">Track and update supplied equipment.</p>
        </a>
        <a href="" class="bg-white hover:bg-blue-50 transition shadow rounded-xl p-5">
            <h2 class="text-xl font-medium text-gray-800">🛠 Maintenance</h2>
            <p class="text-sm text-gray-500 mt-1">View and manage reported issues.</p>
        </a>
        <a href="" class="bg-white hover:bg-blue-50 transition shadow rounded-xl p-5">
            <h2 class="text-xl font-medium text-gray-800">👷 Technicians</h2>
            <p class="text-sm text-gray-500 mt-1">Assign and manage your electricity experts.</p>
        </a>
        <a href="" class="bg-white hover:bg-blue-50 transition shadow rounded-xl p-5">
            <h2 class="text-xl font-medium text-gray-800">⚡ Usage Logs</h2>
            <p class="text-sm text-gray-500 mt-1">Monitor meter readings and consumption data.</p>
        </a>
    </div>
</div>
@endsection
