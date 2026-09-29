<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan - Stockify WMS</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans leading-normal tracking-normal">

    <!-- Navbar -->
    <nav class="bg-white shadow-sm border-b border-gray-200 px-6 py-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <span class="text-xl font-bold text-indigo-600">Stockify WMS</span>
            </div>
            <div class="hidden md:flex space-x-6 text-sm font-medium text-gray-600">
                <a href="{{ route('dashboard') }}" class="hover:text-indigo-600">Dashboard</a>
                <a href="/categories" class="hover:text-indigo-600">Kategori</a>
                <a href="/suppliers" class="hover:text-indigo-600">Supplier</a>
                <a href="/products" class="hover:text-indigo-600">Produk</a>
                <a href="/products/monitoring" class="hover:text-indigo-600">Monitoring</a>
                <a href="/transactions" class="hover:text-indigo-600">Transaksi</a>
                <a href="/users" class="hover:text-indigo-600">Pengguna</a>
                <a href="{{ route('reports.index') }}" class="text-indigo-600 hover:text-indigo-800">Laporan</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-6 py-8">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Laporan Stok & Transaksi 📄</h1>
                <p class="text-gray-500 mt-1">Pantau riwayat transaksi dan unduh laporan resmi gudang dalam format PDF.</p>
            </div>
            <div>
                <!-- Tombol Download PDF -->
                <a href="{{ route('reports.export') }}" target="_blank" class="bg-indigo-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-indigo-700 transition flex items-center space-x-2">
                    <span>Cetak PDF</span>
                </a>
            </div>
        </div>

        <!-- Ringkasan Kartu Statistik Laporan -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <p class="text-sm font-medium text-gray-500">Total Jenis Produk</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalProducts }}</h3>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <p class="text-sm font-medium text-gray-500">Total Seluruh Stok</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalStock }}</h3>
            </div>
        </div>

        <!-- Tabel Transaksi yang Muncul di Depan -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <h3 class="text-lg font-semibold text-gray-800">Riwayat Transaksi Stok Terbaru</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-gray-600 text-sm border-b border-gray-200">
                            <th class="py-3 px-6">No</th>
                            <th class="py-3 px-6">Tanggal</th>
                            <th class="py-3 px-6">Nama Produk</th>
                            <th class="py-3 px-6">Tipe</th>
                            <th class="py-3 px-6">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 text-sm">
                        @forelse($transactions as $index => $trx)
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="py-3 px-6">{{ $index + 1 }}</td>
                            <td class="py-3 px-6">{{ $trx->created_at }}</td>
                            <td class="py-3 px-6 font-medium">{{ $trx->product->name ?? 'Produk Dihapus' }}</td>
                            <td class="py-3 px-6">
                                <span class="px-2 py-1 rounded text-xs font-semibold {{ $trx->type == 'in' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ ucfirst($trx->type) }}
                                </span>
                            </td>
                            <td class="py-3 px-6">{{ $trx->quantity }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-6 text-center text-gray-400">Belum ada data transaksi tercatat.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>