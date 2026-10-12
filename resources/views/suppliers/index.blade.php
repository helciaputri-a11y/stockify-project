@extends('layouts.sidebar')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Card Utama Putih Bersih dengan Border Lembut & Sudut Melengkung Modern -->
    <div class="bg-white border border-slate-200 shadow-sm rounded-2xl p-6 sm:p-8">
        
        <!-- Header Halaman & Tombol Aksi -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6 pb-4 border-b border-slate-100">
            <h1 class="text-xl font-bold text-slate-800 tracking-tight">
                Daftar Supplier
            </h1>
            <div class="flex items-center gap-3">
                <a href="{{ route('suppliers.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs px-4 py-2.5 rounded-xl shadow-sm transition-all flex items-center gap-1.5">
                    + Tambah Supplier
                </a>
                <a href="{{ route('products.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-xs px-4 py-2.5 rounded-xl transition-all">
                    Kembali ke Produk
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs px-4 py-3 rounded-xl mb-6 font-medium">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabel Data Supplier yang Rapi -->
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-slate-700 uppercase tracking-wider text-xs border-b border-slate-200">
                    <tr>
                        <th class="py-3 px-4 font-semibold">Nama Supplier</th>
                        <th class="py-3 px-4 font-semibold">Kontak / Telepon</th>
                        <th class="py-3 px-4 font-semibold">Alamat</th>
                        <th class="py-3 px-4 text-center font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    @forelse ($suppliers as $supplier)
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="py-3.5 px-4 text-slate-900">{{ $supplier->name }}</td>
                            <td class="py-3.5 px-4 text-slate-600">{{ $supplier->phone ?? '-' }}</td>
                            <td class="py-3.5 px-4 text-slate-600">{{ $supplier->address ?? '-' }}</td>
                            <td class="py-3.5 px-4 text-center">
                                <div class="inline-flex items-center gap-1.5">
                                    <a href="{{ route('suppliers.show', $supplier->id) }}" class="bg-blue-50 hover:bg-blue-100 text-blue-600 px-3 py-1.5 rounded-lg text-xs font-semibold transition">
                                        Detail
                                    </a>
                                    <a href="{{ route('suppliers.edit', $supplier->id) }}" class="bg-amber-50 hover:bg-amber-100 text-amber-700 px-3 py-1.5 rounded-lg text-xs font-semibold transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus supplier ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-rose-50 hover:bg-rose-100 text-rose-600 px-3 py-1.5 rounded-lg text-xs font-semibold transition cursor-pointer">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-8 text-center text-slate-400 text-sm">Belum ada data supplier.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection