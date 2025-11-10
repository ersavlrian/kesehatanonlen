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
                    <li><a href="/admin/dashboard" class="flex items-center p-2 rounded-lg hover:bg-indigo-100"><span class="ml-2">🏠 Dashboard</span></a></li>
                    <li><a href="/admin/products" class="flex items-center p-2 rounded-lg bg-indigo-100 text-indigo-700"><span class="ml-2">📦 Produk</span></a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-semibold text-gray-800">Kelola Produk</h2>
                <button onclick="openAddModal()" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                    + Tambah Produk
                </button>
            </div>

            <!-- Filter Kategori -->
            <div class="mb-4 flex items-center space-x-3">
                <label for="categoryFilter" class="text-gray-700 font-medium">Filter Kategori:</label>
                <select id="categoryFilter" onchange="filterByCategory()" class="border rounded-lg px-3 py-2 focus:ring focus:ring-indigo-100">
                    <option value="all">Semua Kategori</option>
                    <option value="sepatu">Sepatu</option>
                    <option value="tas">Tas</option>
                    <option value="jam">Jam</option>
                </select>
            </div>

            <!-- Table -->
            <div class="bg-white p-6 rounded-xl shadow">
                <table class="w-full border-collapse text-left">
                    <thead>
                        <tr class="bg-gray-50 border-b">
                            <th class="p-3 text-gray-600">#</th>
                            <th class="p-3 text-gray-600">Foto</th>
                            <th class="p-3 text-gray-600">Nama Produk</th>
                            <th class="p-3 text-gray-600">Kategori</th>
                            <th class="p-3 text-gray-600">Harga</th>
                            <th class="p-3 text-gray-600">Stok</th>
                            <th class="p-3 text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="productTable">
                        <tr data-category="sepatu" class="border-b hover:bg-gray-50">
                            <td class="p-3">1</td>
                            <td class="p-3"><img src="https://via.placeholder.com/60" class="w-14 h-14 object-cover rounded"></td>
                            <td class="p-3">Sepatu Sport</td>
                            <td class="p-3">Sepatu</td>
                            <td class="p-3">Rp 650.000</td>
                            <td class="p-3">25</td>
                            <td class="p-3 space-x-2">
                                <button onclick="openEditModal(1)" class="text-blue-600 hover:underline">Edit</button>
                                <button onclick="deleteProduct(1)" class="text-red-600 hover:underline">Hapus</button>
                            </td>
                        </tr>
                        <tr data-category="tas" class="border-b hover:bg-gray-50">
                            <td class="p-3">2</td>
                            <td class="p-3"><img src="https://via.placeholder.com/60" class="w-14 h-14 object-cover rounded"></td>
                            <td class="p-3">Tas Kulit</td>
                            <td class="p-3">Tas</td>
                            <td class="p-3">Rp 420.000</td>
                            <td class="p-3">10</td>
                            <td class="p-3 space-x-2">
                                <button onclick="openEditModal(2)" class="text-blue-600 hover:underline">Edit</button>
                                <button onclick="deleteProduct(2)" class="text-red-600 hover:underline">Hapus</button>
                            </td>
                        </tr>
                        <tr data-category="jam" class="border-b hover:bg-gray-50">
                            <td class="p-3">3</td>
                            <td class="p-3"><img src="https://via.placeholder.com/60" class="w-14 h-14 object-cover rounded"></td>
                            <td class="p-3">Jam Tangan</td>
                            <td class="p-3">Jam</td>
                            <td class="p-3">Rp 890.000</td>
                            <td class="p-3">15</td>
                            <td class="p-3 space-x-2">
                                <button onclick="openEditModal(3)" class="text-blue-600 hover:underline">Edit</button>
                                <button onclick="deleteProduct(3)" class="text-red-600 hover:underline">Hapus</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- Modal: Tambah/Edit Produk -->
    <div id="productModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center">
        <div class="bg-white p-6 rounded-xl shadow-lg w-96 relative">
            <h3 id="modalTitle" class="text-xl font-semibold mb-4 text-gray-800">Tambah Produk</h3>
            <form id="productForm" onsubmit="saveProduct(event)">
                <input type="hidden" id="productId">

                <div class="mb-3">
                    <label class="block text-gray-600 text-sm mb-1">Nama Produk</label>
                    <input id="productName" type="text" required class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-indigo-100">
                </div>

                <div class="mb-3">
                    <label class="block text-gray-600 text-sm mb-1">Kategori</label>
                    <select id="productCategory" required class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-indigo-100">
                        <option value="">Pilih Kategori</option>
                        <option value="sepatu">Sepatu</option>
                        <option value="tas">Tas</option>
                        <option value="jam">Jam</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="block text-gray-600 text-sm mb-1">Harga</label>
                    <input id="productPrice" type="number" required class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-indigo-100">
                </div>

                <div class="mb-3">
                    <label class="block text-gray-600 text-sm mb-1">Stok</label>
                    <input id="productStock" type="number" required class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-indigo-100">
                </div>

                <!-- Upload Foto -->
                <div class="mb-3">
                    <label class="block text-gray-600 text-sm mb-1">Foto Produk</label>
                    <input id="productImage" type="file" accept="image/*" onchange="previewImage(event)" class="w-full border rounded-lg px-3 py-2">
                    <img id="imagePreview" class="mt-3 w-32 h-32 object-cover rounded hidden" alt="Preview">
                </div>

                <div class="flex justify-end space-x-2 mt-4">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300">Batal</button>
                    <button type="submit" class="px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openAddModal() {
            document.getElementById("modalTitle").textContent = "Tambah Produk";
            document.getElementById("productForm").reset();
            document.getElementById("productId").value = "";
            document.getElementById("imagePreview").classList.add("hidden");
            document.getElementById("productModal").classList.remove("hidden");
            document.getElementById("productModal").classList.add("flex");
        }

        function openEditModal(id) {
            document.getElementById("modalTitle").textContent = "Edit Produk";
            document.getElementById("productId").value = id;
            document.getElementById("productName").value = "Produk Contoh " + id;
            document.getElementById("productCategory").value = "tas";
            document.getElementById("productPrice").value = 500000;
            document.getElementById("productStock").value = 20;
            document.getElementById("imagePreview").src = "https://via.placeholder.com/100";
            document.getElementById("imagePreview").classList.remove("hidden");
            document.getElementById("productModal").classList.remove("hidden");
            document.getElementById("productModal").classList.add("flex");
        }

        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function(){
                const output = document.getElementById('imagePreview');
                output.src = reader.result;
                output.classList.remove("hidden");
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        function closeModal() {
            document.getElementById("productModal").classList.add("hidden");
        }

        function saveProduct(e) {
            e.preventDefault();
            const id = document.getElementById("productId").value;
            const name = document.getElementById("productName").value;
            const price = document.getElementById("productPrice").value;
            const stock = document.getElementById("productStock").value;
            const category = document.getElementById("productCategory").value;

            if (id) {
                alert(`Produk ${id} diperbarui: ${name}, Kategori: ${category}, Rp ${price}, stok ${stock}`);
            } else {
                alert(`Produk baru ditambahkan: ${name}, Kategori: ${category}, Rp ${price}, stok ${stock}`);
            }
            closeModal();
        }

        function deleteProduct(id) {
            if (confirm(`Hapus produk dengan ID ${id}?`)) {
                alert("Produk berhasil dihapus!");
            }
        }

        function filterByCategory() {
            const filter = document.getElementById("categoryFilter").value;
            const rows = document.querySelectorAll("#productTable tr");
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
