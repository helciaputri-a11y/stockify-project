<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stok Opname - Stockify</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Stok Opname (Audit Fisik)</h1>
        <p class="text-sm text-gray-500 mb-6">Sesuaikan jumlah stok sistem dengan hasil perhitungan fisik di gudang.</p>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('stocks.opname.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Pilih Produk</label>
                <select name="product_id" required class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                    <option value="">-- Pilih Produk --</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }} (Stok Sistem saat ini: {{ $product->stock }})</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Jumlah Stok Fisik (Hasil Hitung di Gudang)</label>
                <input type="number" name="physical_stock" min="0" required class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300" placeholder="Masukkan jumlah fisik sebenarnya">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Alasan / Catatan Audit</label>
                <textarea name="notes" rows="3" required class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300" placeholder="Contoh: Selisih karena barang rusak/hilang"></textarea>
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('stocks.index') }}" class="text-gray-600 hover:underline">Kembali</a>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">Simpan Rekonsiliasi Opname</button>
            </div>
        </form>
    </div>
</body>
</html>