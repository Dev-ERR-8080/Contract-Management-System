@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 flex flex-col items-center justify-center px-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Welcome to Contract Manager ⚙️</h1>
    <p class="text-gray-500 mb-10 text-center">Select a management module to continue:</p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl w-full">
        <a href="{{ route('electricity.dashboard') }}"
           class="bg-white hover:bg-blue-100 border border-gray-200 rounded-2xl shadow-md p-6 transition group">
            <div class="flex items-center space-x-4">
                <div class="bg-blue-200 text-blue-800 p-3 rounded-full text-xl">
                    ⚡
                </div>
                <div>
                    <h2 class="text-xl font-semibold group-hover:text-blue-600">Electricity Contracts</h2>
                    <p class="text-gray-500 text-sm">Manage electricity supply contracts, technicians, and data logs.</p>
                </div>
            </div>
        </a>

        <a href="{{ route('solar.dashboard') }}"
           class="bg-white hover:bg-yellow-100 border border-gray-200 rounded-2xl shadow-md p-6 transition group">
            <div class="flex items-center space-x-4">
                <div class="bg-yellow-200 text-yellow-800 p-3 rounded-full text-xl">
                    ☀️
                </div>
                <div>
                    <h2 class="text-xl font-semibold group-hover:text-yellow-600">Solar Contracts</h2>
                    <p class="text-gray-500 text-sm">Track solar installations, product details, and warranties.</p>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection
