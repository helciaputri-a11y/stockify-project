@extends('layouts.sidebar')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Laporan Stok & Transaksi 📄</h1>
            <p class="text-sm text-slate-500 mt-1">Pantau riwayat transaksi dan unduh laporan resmi gudang dalam format PDF.</p>
        </div>
        <div>
            <!-- Tombol Download PDF -->
            <a href="{{ route('reports.export') }}" target="_blank" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl transition shadow-md shadow-blue-600/30 flex items-center gap-2">
                <span>Cetak PDF</span>
            </a>
        </div>
    </div>

    <!-- Ringkasan Kartu Statistik Laporan -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
            <p class="text-sm font-medium text-slate-500">Total Jenis Produk</p>
            <h3 class="text-3xl font-bold text-slate-800 mt-2">{{ $totalProducts }}</h3>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
            <p class="text-sm font-medium text-slate-500">Total Seluruh Stok</p>
            <h3 class="text-3xl font-bold text-slate-800 mt-2">{{ $totalStock }}</h3>
        </div>
    </div>

    <!-- Tabel Transaksi Terbaru -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6 border-b border-slate-100">
            <h3 class="text-lg font-semibold text-slate-800">Riwayat Transaksi Stok Terbaru</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-slate-400 text-xs uppercase tracking-wider font-semibold">
                        <th class="py-4 px-6 w-16">No</th>
                        <th class="py-4 px-6">Tanggal</th>
                        <th class="py-4 px-6">Nama Produk</th>
                        <th class="py-4 px-6 text-center w-36">Tipe</th>
                        <th class="py-4 px-6 text-center w-28">Jumlah</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm text-slate-600">
                    @forelse($transactions as $index => $trx)
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="py-4 px-6 text-slate-500 font-medium">{{ $index + 1 }}</td>
                        <td class="py-4 px-6 text-slate-500">{{ $trx->created_at }}</td>
                        <td class="py-4 px-6 font-semibold text-slate-800">{{ $trx->product->name ?? 'Produk Dihapus' }}</td>
                        <td class="py-4 px-6 text-center">
                            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $trx->type == 'in' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-rose-50 text-rose-600 border border-rose-200' }}">
                                {{ ucfirst($trx->type) }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-center font-bold text-slate-800">{{ $trx->quantity }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-slate-400 italic">Belum ada data transaksi tercatat.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection