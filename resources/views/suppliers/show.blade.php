<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Supplier - Stockify</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    @include('layouts.navigation')

    <div class="max-w-xl mx-auto bg-white p-8 rounded-lg shadow-md mt-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Detail Supplier</h1>

        <div class="mb-4">
            <label class="block text-gray-500 text-sm font-semibold">Nama Supplier</label>
            <p class="text-lg text-gray-800">{{ $supplier->name }}</p>
        </div>

        <div class="mb-4">
            <label class="block text-gray-500 text-sm font-semibold">Kontak / Telepon</label>
            <p class="text-lg text-gray-800">{{ $supplier->phone ?? '-' }}</p>
        </div>

        <div class="mb-4">
            <label class="block text-gray-500 text-sm font-semibold">Alamat</label>
            <p class="text-lg text-gray-800">{{ $supplier->address ?? '-' }}</p>
        </div>

        <div class="mt-6 flex justify-between items-center">
            <a href="{{ route('suppliers.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Kembali</a>
        </div>
    </div>
</body>
</html>