<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GAGEGO - Home</title>
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
            <a href="{{ route('shop') }}" class="hover:text-indigo-600">SHOP</a>
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

        <div class="mt-10 md:mt-0">
            <img src="{{ asset('img/cover.png') }}" alt="Model" class="w-[400px] md:w-[500px] object-cover">
        </div>
    </section>

    <!-- Featured Products Section -->
    <section id="shop" class="bg-gray-50 py-16">
        <div class="max-w-6xl mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-10">Featured Products</h2>

            @if($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @foreach($products as $product)
                    <div class="bg-white shadow-md rounded-xl overflow-hidden">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-60 object-cover">
                        @else
                            <div class="w-full h-60 flex items-center justify-center bg-gray-200 text-gray-400">No Image</div>
                        @endif
                        <div class="p-4">
                            <h3 class="text-lg font-semibold">{{ $product->name }}</h3>
                            <p class="text-gray-500 mt-1">{{ $product->category->category ?? '-' }}</p>
                            <p class="text-gray-500 mt-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <button class="mt-4 bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Add to Cart</button>
                        </div>
                    </div>
                @endforeach
            </div>
            @else
                <p class="text-center text-gray-500">Belum ada produk tersedia.</p>
            @endif
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-16">
        <div class="max-w-6xl mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-10">Shop by Category</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6 text-center">
                @foreach($categories as $category)
                    <a href="{{ route('shop', ['category' => $category->id]) }}" class="bg-indigo-100 rounded-xl p-6 hover:bg-indigo-200 transition">
                        <img src="{{ asset('images/category'.$category->id.'.png') }}" alt="{{ $category->category }}" class="mx-auto w-20 h-20 object-cover mb-4">
                        <h3 class="font-semibold">{{ $category->category }}</h3>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Promo Section -->
<section class="bg-indigo-600 text-white py-16 mt-16">
    <div class="max-w-6xl mx-auto px-6 text-center">
        <h2 class="text-4xl font-bold mb-4">Special Promo!</h2>
        <p class="mb-6">Get 20% off on selected items. Limited time offer, hurry up!</p>
        <a href="#shop" class="inline-block bg-white text-indigo-600 font-semibold px-6 py-3 rounded-lg hover:bg-gray-100 transition">Shop Now</a>
    </div>
</section>

<!-- Testimonial Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-6xl mx-auto px-6 text-center">
        <h2 class="text-3xl font-bold mb-10">What Our Customers Say</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-xl shadow-md">
                <p class="text-gray-600 mb-4">"Amazing quality and fast delivery. I love my dress!"</p>
                <h3 class="font-semibold">- Sarah L.</h3>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md">
                <p class="text-gray-600 mb-4">"Great customer service and the products are perfect."</p>
                <h3 class="font-semibold">- Michael R.</h3>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md">
                <p class="text-gray-600 mb-4">"Affordable prices and stylish collection. Highly recommend!"</p>
                <h3 class="font-semibold">- Emily T.</h3>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section class="bg-indigo-600 text-white py-16 mt-16">
    <div class="max-w-6xl mx-auto px-6 text-center">
        <h2 class="text-4xl font-bold mb-4">Join Our Newsletter</h2>
        <p class="mb-6">Stay updated with latest arrivals and exclusive offers.</p>
        <form class="flex flex-col sm:flex-row justify-center items-center gap-4 max-w-xl mx-auto">
            <input type="email" placeholder="Enter your email" class="w-full sm:w-auto px-4 py-3 rounded-lg text-gray-800 focus:outline-none">
            <button class="bg-white text-indigo-600 font-semibold px-6 py-3 rounded-lg hover:bg-gray-100 transition">Subscribe</button>
        </form>
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

    <!-- Footer -->
    <footer class="text-center py-6 text-gray-500 text-sm border-t mt-10">
        © 2025 GAGEGO. All rights reserved.
    </footer>

</body>
</html>
