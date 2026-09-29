<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catat Transaksi Stok - Stockify</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Catat Transaksi Stok</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('stocks.store') }}" method="POST">
            @csrf

            <!-- Pilih Produk -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Pilih Produk</label>
                <select name="product_id" required class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                    <option value="">-- Pilih Produk --</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }} (Stok saat ini: {{ $product->stock }})</option>
                    @endforeach
                </select>
            </div>

            <!-- Tipe Transaksi -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Tipe Transaksi</label>
                <select name="type" required class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                    <option value="in">Barang Masuk (Restok)</option>
                    <option value="out">Barang Keluar (Terjual/Keluar)</option>
                </select>
            </div>

            <!-- Jumlah -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Jumlah (Quantity)</label>
                <input type="number" name="quantity" min="1" required class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <!-- Keterangan -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Keterangan / Catatan (Opsional)</label>
                <textarea name="notes" rows="3" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300" placeholder="Misal: Restok dari supplier utama / Penjualan offline"></textarea>
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('stocks.index') }}" class="text-gray-600 hover:underline">Kembali</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Simpan Transaksi</button>
            </div>
        </form>
    </div>
</body>
</html>