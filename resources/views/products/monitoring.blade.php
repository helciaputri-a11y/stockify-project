@extends('layouts.sidebar')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Monitoring Stok Real-Time</h1>
            <p class="text-sm text-slate-500">Pantau ketersediaan stok barang dan status peringatan stok menipis.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('products.index') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold rounded-xl transition shadow-sm">Kembali ke Produk</a>
            <a href="{{ route('stocks.index') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl transition shadow-md shadow-blue-600/30">Manajemen Transaksi</a>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200 text-slate-400 text-xs uppercase tracking-wider font-semibold">
                    <th class="py-4 px-6 w-20">No</th>
                    <th class="py-4 px-6">Nama Produk</th>
                    <th class="py-4 px-6">Kategori</th>
                    <th class="py-4 px-6">Supplier</th>
                    <th class="py-4 px-6 text-center w-32">Jumlah Stok</th>
                    <th class="py-4 px-6 text-center w-36">Status Stok</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm text-slate-600">
                @forelse($products as $index => $product)
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="py-4 px-6 font-medium text-slate-500">{{ $index + 1 }}</td>
                        <td class="py-4 px-6 font-semibold text-slate-800">{{ $product->name }}</td>
                        <td class="py-4 px-6">{{ $product->category->name ?? '-' }}</td>
                        <td class="py-4 px-6">{{ $product->supplier->name ?? '-' }}</td>
                        <td class="py-4 px-6 text-center font-bold text-slate-800">{{ $product->stock }}</td>
                        <td class="py-4 px-6 text-center">
                            @if($product->stock <= 0)
                                <span class="px-3 py-1 bg-rose-50 text-rose-600 border border-rose-200 rounded-full text-xs font-bold">Habis</span>
                            @elseif($product->stock <= 5)
                                <span class="px-3 py-1 bg-amber-50 text-amber-700 border border-amber-200 rounded-full text-xs font-bold">Menipis</span>
                            @else
                                <span class="px-3 py-1 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-full text-xs font-bold">Aman</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-slate-400 italic">Belum ada data produk.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection