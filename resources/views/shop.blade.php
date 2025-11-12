<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop | GAGEGO</title>
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
        <a href="{{ url('/shop') }}" class="hover:text-indigo-600 font-semibold text-indigo-600">SHOP</a>
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

<!-- Hero -->
<section class="bg-gray-50 py-16 text-center">
    <h2 class="text-4xl font-bold mb-2">Shop Our Collection</h2>
    <p class="text-gray-600">Browse our latest products and find your style.</p>
</section>

<!-- Filters -->
<section class="max-w-6xl mx-auto px-6 py-10">
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <!-- Category Filter -->
        <div>
            <label class="font-semibold mr-2">Category:</label>
            <select id="categoryFilter" onchange="applyFilters()" class="border rounded-lg px-3 py-2">
                <option value="all">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ strtolower($category->category) }}">{{ $category->category }}</option>
                @endforeach
            </select>
        </div>

        <!-- Price Filter -->
        <div>
            <label class="font-semibold mr-2">Max Price:</label>
            <input type="number" id="priceFilter" placeholder="Rp" class="border rounded-lg px-3 py-2" oninput="applyFilters()">
        </div>

        <!-- Search -->
        <div class="flex items-center border rounded-lg overflow-hidden w-full md:w-1/3">
            <input type="text" id="searchInput" placeholder="Search products..." class="px-4 py-2 w-full focus:outline-none" onkeyup="applyFilters()">
        </div>
    </div>

    <!-- Products Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8" id="productGrid">
        @forelse($products as $product)
        <div class="bg-white shadow-md rounded-xl overflow-hidden p-4 relative" data-category="{{ strtolower($product->category->category ?? '') }}" data-price="{{ $product->price }}">
            <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-lg mb-4">

            <h3 class="font-semibold text-lg">{{ $product->name }}</h3>
            <p class="text-gray-500 mt-1">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            <p class="text-gray-400 text-sm mt-1">{{ \Illuminate\Support\Str::limit($product->description, 60) }}</p>

            <!-- Hover Overlay -->
            <div class="absolute inset-0 bg-black bg-opacity-40 flex flex-col justify-center items-center opacity-0 hover:opacity-100 transition">
                <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg mb-2 hover:bg-indigo-700">Quick View</button>
                <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">Add to Cart</button>
            </div>
        </div>
        @empty
            <p class="col-span-full text-center text-gray-500">No products found.</p>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $products->links() }}
    </div>
</section>

<!-- Footer -->
<footer class="text-center py-6 text-gray-500 text-sm border-t mt-10">
    © 2025 GAGEGO. All rights reserved.
</footer>

<!-- Filters Script -->
<script>
    function applyFilters() {
        const category = document.getElementById('categoryFilter').value;
        const maxPrice = document.getElementById('priceFilter').value;
        const searchQuery = document.getElementById('searchInput').value.toLowerCase();
        const products = document.querySelectorAll('#productGrid > div');

        products.forEach(product => {
            const productCategory = product.dataset.category;
            const productPrice = parseFloat(product.dataset.price);
            const productName = product.querySelector('h3').textContent.toLowerCase();

            let visible = true;

            if(category !== 'all' && productCategory !== category) visible = false;
            if(maxPrice && productPrice > maxPrice) visible = false;
            if(searchQuery && !productName.includes(searchQuery)) visible = false;

            product.style.display = visible ? '' : 'none';
        });
    }
</script>

</body>
</html>
