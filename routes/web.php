<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StockTransactionController;
use App\Http\Controllers\ReportController;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\StockTransaction;

// 1. Tampilkan halaman login saat akses URL utama (GET)
Route::get('/', function () {
    return view('auth.login');
})->name('login');

// 2. Proses data saat tombol login ditekan (POST)
Route::post('/', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('dashboard');
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ])->onlyInput('email');
});

Route::middleware(['auth'])->group(function () {
    
    // Dashboard & Stok (Bisa diakses oleh semua role termasuk Staff)
    Route::get('/dashboard', function () {
        $totalCategories = Category::count();
        $totalProducts = Product::count();
        $totalSuppliers = Supplier::count();
        $totalTransactions = StockTransaction::count();
        $lowStockProducts = Product::where('stock', '<', 10)->get();
        $products = Product::all();
        return view('dashboard', compact('totalCategories', 'totalProducts', 'totalSuppliers', 'totalTransactions', 'lowStockProducts', 'products'));
    })->name('dashboard');

    Route::resource('stocks', StockController::class)->only(['index', 'create', 'store']);
    Route::get('stocks/opname', [StockController::class, 'opnameCreate'])->name('stocks.opname');
    Route::post('stocks/opname', [StockController::class, 'opnameStore'])->name('stocks.opname.store');

    // Manajemen (Produk, Kategori, Supplier, Transaksi, Laporan, User)
    Route::resource('products', ProductController::class);
    
    // Rute Tambahan untuk Monitoring Produk
    Route::get('/products/monitoring', [ProductController::class, 'monitoring'])->name('products.monitoring');

    Route::resource('categories', CategoryController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('transactions', StockTransactionController::class)->names('transactions');
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/export-pdf', [ReportController::class, 'exportPdf'])->name('reports.export');
    Route::resource('users', UserController::class);

    // Rute Logout
    Route::post('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    })->name('logout');
});