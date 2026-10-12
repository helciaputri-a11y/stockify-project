<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stockify - Detail Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    @include('layouts.navigation')
    
    <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-md mt-6">
        <div class="flex justify-between items-center mb-6 border-b pb-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Detail Produk</h1>
                <p class="text-sm text-gray-500">Informasi lengkap spesifikasi dan data barang di gudang</p>
            </div>
            <a href="{{ route('products.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-lg text-sm">
                &larr; Kembali
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- ID / Kode Produk -->
            <div class="bg-gray-50 p-4 rounded-lg border">
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Kode / ID Produk</span>
                <p class="text-lg font-bold text-indigo-600">PRD-{{ str_pad($product->id, 3, '0', STR_PAD_LEFT) }}</p>
            </div>

            <!-- Nama Produk -->
            <div class="bg-gray-50 p-4 rounded-lg border">
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Nama Produk</span>
                <p class="text-lg font-bold text-gray-800">{{ $product->name }}</p>
            </div>

            <!-- Kategori -->
            <div class="bg-gray-50 p-4 rounded-lg border">
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Jenis / Kategori</span>
                <p class="text-base font-medium text-gray-700">{{ $product->category->name ?? 'Tidak ada kategori' }}</p>
            </div>

            <!-- Supplier -->
            <div class="bg-gray-50 p-4 rounded-lg border">
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Supplier / Pemasok</span>
                <p class="text-base font-medium text-gray-700">{{ $product->supplier->name ?? 'Tidak ada supplier' }}</p>
            </div>

            <!-- Harga -->
            <div class="bg-gray-50 p-4 rounded-lg border">
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Harga Satuan</span>
                <p class="text-lg font-bold text-green-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            </div>

            <!-- Stok -->
            <div class="bg-gray-50 p-4 rounded-lg border">
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Jumlah Stok</span>
                <p class="text-lg font-bold {{ $product->stock < 10 ? 'text-red-600' : 'text-gray-800' }}">
                    {{ $product->stock }} Unit
                    @if($product->stock < 10)
                        <span class="text-xs bg-red-100 text-red-600 px-2 py-0.5 rounded ml-2 font-normal">Stok Menipis!</span>
                    @endif
                </p>
            </div>
        </div>

        <div class="mt-8 flex justify-end space-x-3 border-t pt-4">
            <a href="{{ route('products.edit', $product->id) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-lg text-sm">
                Edit Produk Ini
            </a>
        </div>
    </div>
</body>
</html>