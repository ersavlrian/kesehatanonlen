<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Produk | Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-[Inter]">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-lg">
            <div class="p-6 border-b">
                <h1 class="text-2xl font-bold text-indigo-600">ShopAdmin</h1>
            </div>
            <nav class="p-4">
                <ul class="space-y-2 text-gray-700">
                    <li><a href="{{ route('dashboard') }}" class="flex items-center p-2 rounded-lg hover:bg-indigo-100">🏠 Dashboard</a></li>
                    <li><a href="{{ route('admin.product') }}" class="flex items-center p-2 rounded-lg hover:bg-indigo-100">📦 Produk</a></li>
                    <li><a href="{{ route('admin.category') }}" class="flex items-center p-2 rounded-lg bg-indigo-100 text-indigo-700">📂 Kategori</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-semibold text-gray-800">Manajemen Kategori</h2>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-red-600 font-semibold hover:text-red-800">
                        LogOut
                    </button>
                </form>
            </div>

            <!-- Add Category Form -->
            <div class="bg-white p-6 rounded-xl shadow mb-6">
                <h3 class="text-lg font-semibold mb-4 text-gray-700">➕ Tambah Kategori</h3>
                <form action="{{ route('admin.postcategory') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-600 mb-2">Nama Kategori</label>
                        <input type="text" name="category_name" class="w-full p-2 border rounded-lg focus:ring focus:ring-indigo-200" placeholder="Masukkan nama kategori">
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                            Tambah
                        </button>
                    </div>
                </form>
            </div>

            <!-- Category List -->
            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-lg font-semibold mb-4 text-gray-700">📋 Daftar Kategori</h3>
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b">
                            <th class="p-3 text-gray-600">#</th>
                            <th class="p-3 text-gray-600">Nama Kategori</th>
                            <th class="p-3 text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3">1</td>
                            <td class="p-3">Elektronik</td>
                            <td class="p-3">
                                <button class="text-blue-600 hover:underline">Edit</button> |
                                <button class="text-red-600 hover:underline">Hapus</button>
                            </td>
                        </tr>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3">2</td>
                            <td class="p-3">Fashion</td>
                            <td class="p-3">
                                <button class="text-blue-600 hover:underline">Edit</button> |
                                <button class="text-red-600 hover:underline">Hapus</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>
