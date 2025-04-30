<!DOCTYPE html><<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solar Products</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @stack('styles')
</head>
<body class="bg-gray-100 font-sans leading-relaxed tracking-wider">

    <header class="bg-white shadow-md">
        <div class="container mx-auto p-6 flex justify-between items-center">
            <h1 class="text-3xl font-semibold text-gray-800">SolarVolt</h1>
            <nav>
                <a href="{{ route('dashboard') }}" class="text-gray-700 text-lg hover:text-blue-500">Home</a>
                <a href="{{ route('solar_products.index') }}" class="ml-6 text-gray-700 text-lg hover:text-blue-500">Products</a>
            </nav>
            @auth
            <span>Welcome, {{ Auth::user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        @endauth

        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="bg-white text-center p-4 mt-10">
        <p class="text-gray-600 text-sm">&copy; 2025 SolarVolt. All rights reserved.</p>
    </footer>

    @yield('scripts')
    
</body>


    @yield('scripts')
    
</body>
</html>
