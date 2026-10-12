<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        if (auth()->check() && auth()->user()->role === 'staff') {
            abort(403, 'Akses ditolak.');
        }

        $products = Product::with(['category', 'supplier'])->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('products.create', compact('categories', 'suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:products,code',
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'size' => 'nullable|string|max:50',
            'color' => 'nullable|string|max:50',
        ]);

        Product::create($request->all());

        // Catat log aktivitas tambah produk
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Menambahkan Produk',
            'description' => 'Menambahkan produk baru: ' . $request->name,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('products.edit', compact('product', 'categories', 'suppliers'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'code' => 'required|unique:products,code,' . $product->id,
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'size' => 'nullable|string|max:50',
            'color' => 'nullable|string|max:50',
        ]);

        $product->update($request->all());

        // Catat log aktivitas edit produk
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Mengubah Produk',
            'description' => 'Memperbarui data produk: ' . $product->name,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        $name = $product->name;
        $product->delete();

        // Catat log aktivitas hapus produk
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Menghapus Produk',
            'description' => 'Menghapus produk: ' . $name,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }

    public function monitoring()
    {
        $products = Product::with(['category', 'supplier'])->get();
        return view('products.monitoring', compact('products'));
    }

    public function show($id)
    {
        $product = Product::with(['category', 'supplier'])->findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function activityLogs()
    {
        if (auth()->check() && auth()->user()->role === 'staff') {
            abort(403, 'Akses ditolak.');
        }

        $logs = ActivityLog::with('user')->latest()->get();
        return view('products.logs', compact('logs'));
    }
}