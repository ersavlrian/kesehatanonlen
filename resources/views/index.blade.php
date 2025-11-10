<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body class="font-[Inter] bg-white text-gray-800">

    <!-- Navbar -->
    <header class="flex justify-between items-center px-10 py-6 shadow-sm">
        <div class="flex items-center space-x-2">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-10 h-10 rounded-full">
            <h1 class="text-xl font-bold tracking-wide">GAGEGO</h1>
        </div>

        <nav class="flex space-x-8 font-medium">
            <a href="{{ url('/') }}" class="hover:text-indigo-600">HOME</a>
            <a href="#" class="hover:text-indigo-600">SHOP</a>
            <a href="#" class="hover:text-indigo-600">CART</a>
            <a href="#" class="hover:text-indigo-600">ABOUT</a>
            <a href="#" class="hover:text-indigo-600">CONTACT</a>
        </nav>

        <div class="flex items-center space-x-5 text-sm">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="font-semibold hover:text-indigo-600">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="font-semibold hover:text-indigo-600">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="font-semibold hover:text-indigo-600">Register</a>
                    @endif
                @endauth
            @endif
        </div>
    </header>

    <!-- Hero Section -->
    <section class="flex flex-col md:flex-row items-center justify-between px-10 md:px-20 py-16 md:py-24">
        <!-- Left Text -->
        <div class="max-w-lg space-y-4">
            <p class="uppercase tracking-wide text-gray-500 font-semibold">New Arrivals</p>
            <h2 class="text-5xl md:text-6xl font-bold leading-tight">
                Night Spring <br>
                <span class="text-black">Dresses</span>
            </h2>
            <a href="#shop" class="inline-block mt-6 border-b-2 border-gray-800 text-gray-800 font-medium hover:text-indigo-600 hover:border-indigo-600 transition">
                Shop Now
            </a>
        </div>

        <!-- Right Image -->
        <div class="mt-10 md:mt-0">
            <img src="{{ asset('images/model.png') }}" alt="Model" class="w-[400px] md:w-[500px] object-cover">
        </div>
    </section>

    <!-- Featured Products Section -->
    <section id="shop" class="bg-gray-50 py-16">
        <div class="max-w-6xl mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-10">Featured Products</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                <div class="bg-white shadow-md rounded-xl overflow-hidden">
                    <img src="{{ asset('images/product1.jpg') }}" alt="Product 1" class="w-full h-60 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">Elegant Dress</h3>
                        <p class="text-gray-500 mt-2">Rp 450.000</p>
                        <button class="mt-4 bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Add to Cart</button>
                    </div>
                </div>

                <div class="bg-white shadow-md rounded-xl overflow-hidden">
                    <img src="{{ asset('images/product2.jpg') }}" alt="Product 2" class="w-full h-60 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">Casual Blouse</h3>
                        <p class="text-gray-500 mt-2">Rp 350.000</p>
                        <button class="mt-4 bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Add to Cart</button>
                    </div>
                </div>

                <div class="bg-white shadow-md rounded-xl overflow-hidden">
                    <img src="{{ asset('images/product3.jpg') }}" alt="Product 3" class="w-full h-60 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">Stylish Coat</h3>
                        <p class="text-gray-500 mt-2">Rp 550.000</p>
                        <button class="mt-4 bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Add to Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center py-6 text-gray-500 text-sm border-t mt-10">
        © 2025 Surfside Media. All rights reserved.
    </footer>

    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/a2e0e6a64b.js" crossorigin="anonymous"></script>
</body>
</html>
