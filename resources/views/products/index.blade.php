@extends('layouts.sidebar')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="bg-white border border-slate-200 shadow-sm rounded-2xl p-6 sm:p-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6 pb-4 border-b border-slate-100">
            <h1 class="text-xl font-bold text-slate-800 tracking-tight">Daftar Produk</h1>
            <div class="flex flex-wrap items-center gap-2">
                <a href="{{ route('categories.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-xs px-3.5 py-2.5 rounded-xl transition-all">Kelola Kategori</a>
                <a href="{{ route('suppliers.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-xs px-3.5 py-2.5 rounded-xl transition-all">Kelola Supplier</a>
                <a href="{{ route('products.monitoring') }}" class="bg-purple-600 hover:bg-purple-700 text-white font-semibold text-xs px-3.5 py-2.5 rounded-xl transition-all">Monitoring Stok</a>
                <a href="{{ route('stocks.opname') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs px-3.5 py-2.5 rounded-xl transition-all">Stok Opname</a>
                <a href="{{ route('products.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs px-3.5 py-2.5 rounded-xl shadow-sm transition-all">+ Tambah Produk</a>
            </div>
        </div>

        @if (session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs px-4 py-3 rounded-xl mb-6 font-medium">
                {{ session('success') }}
            </div>
        @endif

        <!-- Kotak Input Pencarian -->
        <div class="mb-6">
            <input type="text" id="searchInput" placeholder="Cari nama produk..." class="w-full md:w-1/3 px-4 py-2 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-slate-700 uppercase tracking-wider text-xs border-b border-slate-200">
                    <tr>
                        <th class="py-3 px-4 font-semibold">Nama Produk</th>
                        <th class="py-3 px-4 font-semibold">Ukuran / Warna</th> <!-- <-- Kolom Baru Ditambahkan -->
                        <th class="py-3 px-4 font-semibold">Harga</th>
                        <th class="py-3 px-4 text-center font-semibold">Stok</th>
                        <th class="py-3 px-4 text-center font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    @forelse ($products as $product)
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="py-3.5 px-4 text-slate-900 font-semibold">{{ $product->name }}</td>
                            <td class="py-3.5 px-4 text-slate-600">
                                {{ $product->size ?? '-' }} / {{ $product->color ?? '-' }} <!-- <-- Menampilkan Data Ukuran & Warna -->
                            </td>
                            <td class="py-3.5 px-4 text-slate-600">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="py-3.5 px-4 text-center text-slate-700">{{ $product->stock }}</td>
                            <td class="py-3.5 px-4 text-center">
                                <div class="inline-flex items-center gap-2">
                                    <a href="{{ route('products.show', $product->id) }}" class="text-blue-600 hover:underline font-semibold text-xs">Detail</a>
                                    <a href="{{ route('products.edit', $product->id) }}" class="text-indigo-600 hover:underline font-semibold text-xs">Edit</a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-rose-600 hover:underline font-semibold text-xs cursor-pointer">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-slate-400 text-sm">Belum ada data produk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Skrip JavaScript Live Search -->
<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let keyword = this.value.toLowerCase();
        let rows = document.querySelectorAll('tbody tr');

        rows.forEach(row => {
            let text = row.textContent.toLowerCase();
            if (text.includes(keyword)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
@endsection