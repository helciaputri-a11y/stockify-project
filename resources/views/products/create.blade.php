<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk Baru - Stockify</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Tambah Produk Baru</h1>

        <!-- Pesan Error Validasi (jika ada kode yang kembar atau kosong) -->
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.store') }}" method="POST">
            @csrf

            <!-- Kode Produk / SKU (Unik) -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Kode Produk / SKU (Unik)</label>
                <input type="text" name="code" value="{{ old('code') }}" placeholder="Contoh: PRD-001" required class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <!-- Pilihan Kategori -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Kategori</label>
                <select name="category_id" required class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Pilihan Supplier -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Supplier</label>
                <select name="supplier_id" required class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                    <option value="">-- Pilih Supplier --</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Nama Produk -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Produk</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <!-- Ukuran Produk (Size) -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Ukuran (Size) <span class="text-gray-400 font-normal">(Opsional)</span></label>
                <input type="text" name="size" value="{{ old('size') }}" placeholder="Contoh: L, XL, 42, All Size" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <!-- Warna Produk (Color) -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Warna (Color) <span class="text-gray-400 font-normal">(Opsional)</span></label>
                <input type="text" name="color" value="{{ old('color') }}" placeholder="Contoh: Hitam, Navy, Putih" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <!-- Harga Produk -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Harga (Rp)</label>
                <input type="number" name="price" value="{{ old('price') }}" required class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <!-- Stok Produk -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Stok</label>
                <input type="number" name="stock" value="{{ old('stock') }}" required class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('products.index') }}" class="text-gray-600 hover:underline">Kembali</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Simpan Produk</button>
            </div>
        </form>
    </div>
</body>
</html>