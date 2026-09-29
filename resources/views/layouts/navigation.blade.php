<div class="max-w-5xl mx-auto bg-white p-4 rounded-lg shadow-md mb-6 flex justify-between items-center">
    <div class="flex items-center space-x-3">
        <span class="text-xl font-bold text-blue-600">Stockify WMS</span>
    </div>
    <div class="flex space-x-4 items-center">
        <!-- Dashboard (Muncul untuk semua role termasuk Staff) -->
        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-blue-600 font-semibold text-sm">Dashboard</a>

        <!-- Stok (Muncul untuk Admin, Manager, & Staff) -->
    @if(in_array(auth()->user()->role ?? 'staff', ['admin', 'manager', 'staff']))
        <a href="{{ route('stocks.index') }}" class="text-gray-700 hover:text-blue-600 font-semibold text-sm">Stok</a>
    @endif

        <!-- Menu untuk ADMIN & MANAGER SAJA -->
        @if(in_array(auth()->user()->role ?? 'staff', ['admin', 'manager']))
            <a href="{{ route('categories.index') }}" class="text-gray-700 hover:text-blue-600 font-semibold text-sm">Kategori</a>
            <a href="{{ route('suppliers.index') }}" class="text-gray-700 hover:text-blue-600 font-semibold text-sm">Supplier</a>
            <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-blue-600 font-semibold text-sm">Produk</a>
            <a href="{{ route('transactions.index') }}" class="text-gray-700 hover:text-blue-600 font-semibold text-sm">Transaksi</a>
            <a href="{{ route('reports.index') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Laporan</a>
        @endif

        <!-- Menu KHUSUS ADMIN SAJA -->
        @if((auth()->user()->role ?? 'staff') === 'admin')
            <a href="{{ route('users.index') }}" class="text-purple-600 hover:text-purple-800 font-bold text-sm bg-purple-100 px-3 py-1 rounded-lg">Pengguna</a>
        @endif
    </div>
</div>