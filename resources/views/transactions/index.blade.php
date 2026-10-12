@extends('layouts.sidebar')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Riwayat Transaksi Barang Masuk & Keluar</h1>
            <p class="text-sm text-slate-500">Pantau seluruh catatan arus keluar masuk stok barang.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('transactions.create') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl transition shadow-md shadow-blue-600/30">+ Catat Transaksi</a>
            <a href="{{ route('products.index') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold rounded-xl transition shadow-sm">Kembali ke Produk</a>
        </div>
    </div>

    @if (session('success'))
        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200 text-slate-400 text-xs uppercase tracking-wider font-semibold">
                    <th class="py-4 px-6">Tanggal</th>
                    <th class="py-4 px-6">Nama Produk</th>
                    <th class="py-4 px-6 text-center w-36">Tipe</th>
                    <th class="py-4 px-6 text-center w-28">Jumlah</th>
                    <th class="py-4 px-6">Keterangan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm text-slate-600">
                @forelse ($transactions as $trx)
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="py-4 px-6 text-slate-500 font-medium">{{ $trx->created_at->format('d-m-Y H:i') }}</td>
                        <td class="py-4 px-6 font-semibold text-slate-800">{{ $trx->product->name ?? 'Produk Dihapus' }}</td>
                        <td class="py-4 px-6 text-center">
                            @if($trx->type == 'in')
                                <span class="px-3 py-1 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-full text-xs font-bold">Barang Masuk</span>
                            @else
                                <span class="px-3 py-1 bg-rose-50 text-rose-600 border border-rose-200 rounded-full text-xs font-bold">Barang Keluar</span>
                            @endif
                        </td>
                        <td class="py-4 px-6 text-center font-bold text-slate-800">{{ $trx->quantity }}</td>
                        <td class="py-4 px-6 text-slate-600">{{ $trx->description ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-slate-400 italic">Belum ada riwayat transaksi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection