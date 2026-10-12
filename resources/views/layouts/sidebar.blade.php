<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stockify WMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-800 antialiased font-sans">

    <div class="flex h-screen overflow-hidden">
        
        <!-- SIDEBAR KIRI -->
        <aside class="w-64 bg-slate-900 border-r border-slate-800 flex flex-col justify-between hidden md:flex shrink-0">
            <div>
                <!-- Logo / Brand -->
                <div class="h-16 flex items-center px-6 gap-3 border-b border-slate-800">
                    <div class="w-9 h-9 bg-blue-600 rounded-xl flex items-center justify-center font-bold text-white shadow-lg shadow-blue-500/30">
                        S
                    </div>
                    <span class="font-bold text-lg tracking-wide text-white">STOCKIFY</span>
                </div>

                <!-- Menu Navigasi Vertikal Berdasarkan Role -->
                <nav class="p-4 space-y-1.5 text-sm font-medium">
                    
                    <!-- 1. DASHBOARD (Semua Role Bisa Akses) -->
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/30 font-semibold' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                        <span>📊</span> Dashboard
                    </a>

                    <!-- ================= MENU KHUSUS ADMIN ================= -->
                    @if(auth()->check() && auth()->user()->role === 'admin')
                        <a href="{{ route('categories.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('categories.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/30 font-semibold' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                            <span>📁</span> Kategori
                        </a>
                        <a href="{{ route('suppliers.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('suppliers.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/30 font-semibold' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                            <span>🚚</span> Supplier
                        </a>
                        <a href="{{ route('products.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ (request()->routeIs('products.*') && !request()->routeIs('products.monitoring') && !request()->routeIs('activity.logs')) ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/30 font-semibold' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                            <span>📦</span> Data Barang
                        </a>
                        <a href="{{ route('products.monitoring') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('products.monitoring') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/30 font-semibold' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                            <span>📈</span> Monitoring
                        </a>
                        <a href="{{ route('transactions.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('transactions.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/30 font-semibold' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                            <span>🔄</span> Stok & Transaksi
                        </a>
                        <a href="{{ route('users.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('users.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/30 font-semibold' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                            <span>👥</span> Pengguna
                        </a>
                        <a href="{{ route('reports.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('reports.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/30 font-semibold' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                            <span>📑</span> Laporan
                        </a>
                        <!-- Menu Log Aktivitas Baru -->
                        <a href="{{ route('activity.logs') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('activity.logs') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/30 font-semibold' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                            <span>📋</span> Log Aktivitas
                        </a>
                    @endif

                    <!-- ================= MENU KHUSUS MANAJER GUDANG ================= -->
                    @if(auth()->check() && auth()->user()->role === 'manager')
                        <a href="{{ route('products.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('products.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/30 font-semibold' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                            <span>📦</span> Daftar Barang
                        </a>
                        <a href="{{ route('suppliers.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('suppliers.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/30 font-semibold' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                            <span>🚚</span> Daftar Supplier
                        </a>
                        <a href="{{ route('transactions.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('transactions.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/30 font-semibold' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                            <span>🔄</span> Transaksi Stok
                        </a>
                        <a href="{{ route('reports.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('reports.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/30 font-semibold' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                            <span>📑</span> Laporan Stok & Masuk/Keluar
                        </a>
                    @endif

                    <!-- ================= MENU KHUSUS STAFF GUDANG ================= -->
                    @if(auth()->check() && auth()->user()->role === 'staff')
                        <a href="{{ route('transactions.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('transactions.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/30 font-semibold' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                            <span>🔄</span> Konfirmasi Stok
                        </a>
                    @endif

                </nav>
            </div>

            <!-- Tombol Keluar Akun -->
            <div class="p-4 border-t border-slate-800">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-rose-400 hover:bg-rose-500/10 hover:text-rose-300 transition text-sm font-semibold cursor-pointer">
                        <span>🚪</span> Keluar Akun
                    </button>
                </form>
            </div>
        </aside>

        <!-- AREA KONTEN UTAMA -->
        <div class="flex-1 flex flex-col overflow-y-auto">
            <header class="h-16 bg-white border-b border-slate-200 px-6 sm:px-10 flex justify-between items-center shadow-sm shrink-0">
                <div class="flex items-center gap-3">
                    <span class="text-sm font-semibold text-slate-700">Sistem Aktif</span>
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                </div>
                <div class="flex items-center gap-3">
                    <div class="text-xs font-medium text-slate-600 bg-blue-50 px-3 py-1.5 rounded-xl border border-blue-100">
                        {{ Auth::user()->name ?? 'User' }} <span class="text-blue-600 font-semibold">({{ Auth::user()->role ?? '' }})</span>
                    </div>
                </div>
            </header>

            <main class="p-6 sm:p-10 flex-1">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>