<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stockify - Edit Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    @include('layouts.navigation')

    <div class="max-w-xl mx-auto bg-white p-8 rounded-lg shadow-md mt-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Produk</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Kode Produk / SKU -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Kode Produk / SKU (Unik)</label>
                <input type="text" name="code" value="{{ old('code', $product->code) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Nama Produk -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Nama Produk</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Ukuran Produk (Size) -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Ukuran (Size) <span class="text-gray-400 font-normal">(Opsional)</span></label>
                <input type="text" name="size" value="{{ old('size', $product->size) }}" placeholder="Contoh: L, XL, 42" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Warna Produk (Color) -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Warna (Color) <span class="text-gray-400 font-normal">(Opsional)</span></label>
                <input type="text" name="color" value="{{ old('color', $product->color) }}" placeholder="Contoh: Hitam, Navy" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Kategori -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Kategori</label>
                <select name="category_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Supplier -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Supplier</label>
                <select name="supplier_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">Pilih Supplier</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ old('supplier_id', $product->supplier_id) == $supplier->id ? 'selected' : '' }}>
                            {{ $supplier->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Harga (Rp) -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Harga (Rp)</label>
                <input type="number" name="price" value="{{ old('price', $product->price) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Stok -->
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Stok</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('products.index') }}" class="text-gray-600 hover:underline">Batal</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg">Update Produk</button>
            </div>
        </form>
    </div>
</body>
</html>