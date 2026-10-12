@extends('layouts.sidebar')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Kotak Selamat Datang -->
    <div class="bg-white overflow-hidden shadow-sm border border-slate-200 rounded-2xl p-6 mb-6">
        <h1 class="text-2xl font-semibold text-slate-800 mb-2">Selamat Datang, {{ auth()->user()->name ?? 'Pengguna' }}!</h1>
        <p class="text-slate-600">Kamu masuk sebagai: <span class="font-semibold uppercase text-blue-600">{{ auth()->user()->role ?? 'staff' }}</span></p>
    </div>

    <!-- Ringkasan Statistik Dashboard -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
            <p class="text-sm font-medium text-slate-500">Total Produk</p>
            <p class="text-3xl font-bold text-slate-800 mt-2">{{ $totalProducts ?? 0 }}</p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
            <p class="text-sm font-medium text-slate-500">Total Kategori</p>
            <p class="text-3xl font-bold text-slate-800 mt-2">{{ $totalCategories ?? 0 }}</p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
            <p class="text-sm font-medium text-slate-500">Total Supplier</p>
            <p class="text-3xl font-bold text-slate-800 mt-2">{{ $totalSuppliers ?? 0 }}</p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
            <p class="text-sm font-medium text-slate-500">Total Transaksi</p>
            <p class="text-3xl font-bold text-slate-800 mt-2">{{ $totalTransactions ?? 0 }}</p>
        </div>
    </div>
</div>
@endsection