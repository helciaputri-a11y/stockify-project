<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockTransaction;
use Illuminate\Http\Request;

class StockTransactionController extends Controller
{
    public function index()
    {
        $transactions = StockTransaction::with('product')->latest()->get();
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $products = Product::all();
        return view('transactions.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($request->type == 'out' && $product->stock < $request->quantity) {
            return back()->withErrors(['quantity' => 'Stok produk tidak mencukupi untuk transaksi keluar!'])->withInput();
        }

        StockTransaction::create($request->all());

        if ($request->type == 'in') {
            $product->increment('stock', $request->quantity);
        } else {
            $product->decrement('stock', $request->quantity);
        }

        return redirect()->route('transactions.index')->with('success', 'Transaksi stok berhasil dicatat.');
    }
}