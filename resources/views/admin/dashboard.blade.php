<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | E-Commerce</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-100 font-[Inter]">

    <!-- Sidebar -->
    <div class="flex min-h-screen">
        <aside class="w-64 bg-white shadow-lg">
            <div class="p-6 border-b">
                <h1 class="text-2xl font-bold text-indigo-600">ShopAdmin</h1>
            </div>

            <nav class="p-4">
                <ul class="space-y-2 text-gray-700">

                    <!-- Dashboard -->
                    <li>
                        <a href="#" class="flex items-center p-2 rounded-lg hover:bg-indigo-100">
                            <span class="ml-2">🏠 Dashboard</span>
                        </a>
                    </li>

                    <!-- Produk -->
                    <li>
                        <a href="{{ route('admin.product') }}" class="flex items-center p-2 rounded-lg hover:bg-indigo-100">
                            <span class="ml-2">📦 Produk</span>
                        </a>
                    </li>

<li>
    <a href="{{ route('admin.category') }}" class="flex items-center p-2 rounded-lg hover:bg-indigo-100">
        <span class="ml-2">📂 Kategori</span>
    </a>
</li>


                    <!-- Others -->
                    <li>
                        <a href="#" class="flex items-center p-2 rounded-lg hover:bg-indigo-100">
                            <span class="ml-2">🛒 Pesanan</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-2 rounded-lg hover:bg-indigo-100">
                            <span class="ml-2">👤 Pelanggan</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-2 rounded-lg hover:bg-indigo-100">
                            <span class="ml-2">⚙️ Pengaturan</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-semibold text-gray-800">Dashboard</h2>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-red-600 font-semibold hover:text-red-800">
                        LogOut
                    </button>
                </form>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                    <h3 class="text-gray-500 text-sm">Total Produk</h3>
                    <p class="text-2xl font-semibold text-gray-800 mt-2">1,245</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                    <h3 class="text-gray-500 text-sm">Total Pesanan</h3>
                    <p class="text-2xl font-semibold text-gray-800 mt-2">872</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                    <h3 class="text-gray-500 text-sm">Total Pendapatan</h3>
                    <p class="text-2xl font-semibold text-gray-800 mt-2">Rp 58.4jt</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                    <h3 class="text-gray-500 text-sm">Pelanggan</h3>
                    <p class="text-2xl font-semibold text-gray-800 mt-2">3,210</p>
                </div>
            </div>

            <!-- Sales Chart -->
            <div class="bg-white p-6 rounded-xl shadow mb-6">
                <h3 class="text-lg font-semibold mb-4 text-gray-700">Statistik Penjualan</h3>
                <canvas id="salesChart" class="w-full h-64"></canvas>
            </div>

            <!-- Recent Orders Table -->
            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-lg font-semibold mb-4 text-gray-700">Pesanan Terbaru</h3>
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b">
                            <th class="p-3 text-gray-600">#</th>
                            <th class="p-3 text-gray-600">Nama Pelanggan</th>
                            <th class="p-3 text-gray-600">Produk</th>
                            <th class="p-3 text-gray-600">Total</th>
                            <th class="p-3 text-gray-600">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3">1</td>
                            <td class="p-3">Andi Wijaya</td>
                            <td class="p-3">Sepatu Sport</td>
                            <td class="p-3">Rp 650.000</td>
                            <td class="p-3"><span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-sm">Selesai</span></td>
                        </tr>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3">2</td>
                            <td class="p-3">Rina Kartika</td>
                            <td class="p-3">Tas Kulit</td>
                            <td class="p-3">Rp 420.000</td>
                            <td class="p-3"><span class="bg-yellow-100 text-yellow-600 px-3 py-1 rounded-full text-sm">Proses</span></td>
                        </tr>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3">3</td>
                            <td class="p-3">Budi Santoso</td>
                            <td class="p-3">Jam Tangan</td>
                            <td class="p-3">Rp 890.000</td>
                            <td class="p-3"><span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-sm">Dibatalkan</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Dropdown Logic -->
    <script>
        // Dropdown open/close
        const btn = document.getElementById('dropdownBtn');
        const menu = document.getElementById('dropdownMenu');
        const icon = document.getElementById('dropdownIcon');

        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
        });

        // Chart
        const ctx = document.getElementById('salesChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                datasets: [{
                    label: 'Penjualan',
                    data: [12000000, 15000000, 13000000, 18000000, 22000000, 20000000],
                    borderColor: '#6366F1',
                    backgroundColor: 'rgba(99, 102, 241, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: { y: { ticks: { callback: val => 'Rp ' + val.toLocaleString() } } }
            }
        });
    </script>
</body>
</html>
