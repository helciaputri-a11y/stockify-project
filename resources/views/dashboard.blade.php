<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Stockify WMS</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased">

    <!-- Navbar -->
    <nav class="bg-white shadow-sm border-b border-gray-200 px-6 py-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <span class="text-xl font-bold text-indigo-600">Stockify WMS</span>
            </div>
            
            <div class="hidden md:flex space-x-6 text-sm font-medium text-gray-600">
                <a href="{{ route('dashboard') }}" class="text-indigo-600 hover:text-indigo-800">Dashboard</a>
                
                <!-- Menu Stok untuk Admin, Manager, & Staff -->
                @if(in_array(auth()->user()->role ?? 'staff', ['admin', 'manager', 'staff']))
                    <a href="{{ route('stocks.index') }}" class="hover:text-indigo-600">Stok</a>
                @endif

                <!-- Menu untuk Admin & Manager -->
                @if(in_array(auth()->user()->role ?? 'staff', ['admin', 'manager']))
                    <a href="/categories" class="hover:text-indigo-600">Kategori</a>
                    <a href="/suppliers" class="hover:text-indigo-600">Supplier</a>
                    <a href="/products" class="hover:text-indigo-600">Produk</a>
                    <a href="/products/monitoring" class="hover:text-indigo-600">Monitoring</a>
                    <a href="/transactions" class="hover:text-indigo-600">Transaksi</a>
                    <a href="/reports" class="hover:text-indigo-600">Laporan</a>
                @endif

                <!-- Menu KHUSUS ADMIN SAJA -->
                @if((auth()->user()->role ?? 'staff') === 'admin')
                    <a href="/users" class="hover:text-indigo-600">Pengguna</a>
                @endif
            </div>

            <!-- Tombol Logout -->
            <div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-800">Keluar</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-6 py-8">
        <!-- Kotak Selamat Datang -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
            <h1 class="text-2xl font-semibold text-gray-800 mb-2">Selamat Datang, {{ auth()->user()->name ?? 'Pengguna' }}!</h1>
            <p class="text-gray-600">Kamu masuk sebagai: <span class="font-semibold uppercase text-indigo-600">{{ auth()->user()->role ?? 'staff' }}</span></p>
        </div>

        <!-- Ringkasan Statistik Dashboard -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                <p class="text-sm font-medium text-gray-500">Total Produk</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalProducts ?? 0 }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                <p class="text-sm font-medium text-gray-500">Total Kategori</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalCategories ?? 0 }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                <p class="text-sm font-medium text-gray-500">Total Supplier</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalSuppliers ?? 0 }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                <p class="text-sm font-medium text-gray-500">Total Transaksi</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalTransactions ?? 0 }}</p>
            </div>
        </div>
    </main>

</body>
</html>