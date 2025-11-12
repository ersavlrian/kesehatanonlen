<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Produk | Admin E-Commerce</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

<div class="min-h-screen flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg">
        <div class="p-6 border-b">
            <h1 class="text-2xl font-bold text-indigo-600">ShopAdmin</h1>
        </div>
        <nav class="p-4">
            <ul class="space-y-2 text-gray-700">
                <li>
                    <a href="dashboard" class="flex items-center p-2 rounded-lg hover:bg-indigo-100">
                        <span class="ml-2">🏠 Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/products" class="flex items-center p-2 rounded-lg bg-indigo-100 text-indigo-700">
                        <span class="ml-2">📦 Produk</span>
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-semibold text-gray-800">Kelola Produk</h2>
        </div>

        <!-- Filter dan Tombol Tambah -->
        <div class="mb-4 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <label for="categoryFilter" class="text-gray-700 font-medium">Filter Kategori:</label>
                <select id="categoryFilter" onchange="filterByCategory()" class="border rounded-lg px-3 py-2 focus:ring focus:ring-indigo-100">
                    <option value="all">Semua Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ strtolower($category->category) }}">{{ $category->category }}</option>
                    @endforeach
                </select>
            </div>

            <button onclick="openAddModal()" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                + Tambah Produk
            </button>
        </div>

        <!-- Table Produk -->
        <div class="bg-white p-6 rounded-xl shadow">
            <table id="productTable" class="w-full border-collapse text-left">
                <thead>
                    <tr class="bg-gray-50 border-b">
                        <th class="p-3 text-gray-600">#</th>
                        <th class="p-3 text-gray-600">Foto</th>
                        <th class="p-3 text-gray-600">Nama Produk</th>
                        <th class="p-3 text-gray-600">Kategori</th>
                        <th class="p-3 text-gray-600">Deskripsi</th>
                        <th class="p-3 text-gray-600">Harga</th>
                        <th class="p-3 text-gray-600">Stok</th>
                        <th class="p-3 text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $index => $product)
                        <tr data-category="{{ strtolower($product->category->category ?? '') }}" class="border-b hover:bg-gray-50">
                            <td class="p-3">{{ $index + 1 }}</td>
                            <td class="p-3">
                                @if ($product->image)
                                    <img src="{{ asset('storage/'.$product->image) }}" class="w-14 h-14 object-cover rounded">
                                @else
                                    <span class="text-gray-400 italic">Tidak ada</span>
                                @endif
                            </td>
                            <td class="p-3">{{ $product->name }}</td>
                            <td class="p-3">{{ $product->category->category ?? '-' }}</td>
                            <td class="p-3">{{ \Illuminate\Support\Str::limit($product->description, 50) }}</td>
                            <td class="p-3">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="p-3">{{ $product->stock }}</td>
                            <td class="p-3 space-x-2">
                                <button 
                                    onclick="openEditModal({{ $product->id }}, '{{ addslashes($product->name) }}', '{{ $product->category_id }}', '{{ $product->price }}', '{{ $product->stock }}', '{{ addslashes($product->description) }}')" 
                                    class="text-blue-600 hover:underline">Edit</button>

                                <form action="{{ route('deleteproduct', $product->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center p-4 text-gray-500">Belum ada produk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-4">
                {{ $products->links() }}
            </div>
        </div>
    </main>
</div>

<!-- Modal Tambah/Edit Produk -->
<div id="productModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center">
    <div class="bg-white p-6 rounded-xl shadow-lg w-96 relative">
        <h3 id="modalTitle" class="text-xl font-semibold mb-4 text-gray-800">Tambah Produk</h3>

        <form id="productForm" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">

            <div>
                <label class="block font-medium">Nama Produk</label>
                <input type="text" name="name" id="name" class="border rounded w-full p-2" required>
            </div>

            <div>
                <label class="block font-medium">Kategori</label>
                <select name="category_id" id="category_id" class="border rounded w-full p-2" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-medium">Harga</label>
                <input type="number" name="price" id="price" class="border rounded w-full p-2" required>
            </div>

            <div>
                <label class="block font-medium">Stok</label>
                <input type="number" name="stock" id="stock" class="border rounded w-full p-2" required>
            </div>

            <div>
                <label class="block font-medium">Deskripsi Produk</label>
                <textarea name="description" id="description" class="border rounded w-full p-2" rows="3"></textarea>
            </div>

            <div>
                <label class="block font-medium">Gambar Produk</label>
                <input type="file" name="image" accept="image/*" class="border rounded w-full p-2">
            </div>

            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeModal()" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
                    Batal
                </button>
                <button type="submit" id="submitButton" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Tambah Produk
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Script -->
<script>
    const modal = document.getElementById("productModal");
    const form = document.getElementById("productForm");
    const modalTitle = document.getElementById("modalTitle");
    const submitButton = document.getElementById("submitButton");

    function openAddModal() {
        form.reset();
        form.action = "{{ route('addproduct') }}";
        document.getElementById("formMethod").value = "POST";
        modalTitle.textContent = "Tambah Produk";
        submitButton.textContent = "Tambah Produk";

        modal.classList.remove("hidden");
        modal.classList.add("flex");
    }

    function openEditModal(id, name, category_id, price, stock, description) {
        form.action = "product/update/" + id;
        document.getElementById("formMethod").value = "PUT";
        modalTitle.textContent = "Edit Produk";
        submitButton.textContent = "Simpan Perubahan";

        document.getElementById("name").value = name;
        document.getElementById("category_id").value = category_id;
        document.getElementById("price").value = price;
        document.getElementById("stock").value = stock;
        document.getElementById("description").value = description;

        modal.classList.remove("hidden");
        modal.classList.add("flex");
    }

    function closeModal() {
        modal.classList.add("hidden");
    }

    function filterByCategory() {
        const filter = document.getElementById("categoryFilter").value;
        const rows = document.querySelectorAll("#productTable tbody tr");
        rows.forEach(row => {
            if (filter === "all" || row.dataset.category === filter) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }
</script>
</body>
</html>
