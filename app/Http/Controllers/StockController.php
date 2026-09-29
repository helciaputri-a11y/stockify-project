<?php

namespace App\Http\Controllers;

use App\Models\StockTransaction;
use App\Models\Product;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $transactions = StockTransaction::with('product')->latest()->get();
        return view('stocks.index', compact('transactions'));
    }

    public function create()
    {
        $products = Product::all();
        return view('stocks.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Logika penambahan atau pengurangan stok produk otomatis
        if ($request->type === 'in') {
            $product->stock += $request->quantity;
        } else {
            if ($product->stock < $request->quantity) {
                return back()->withErrors(['quantity' => 'Stok tidak mencukupi untuk pengeluaran ini!'])->withInput();
            }
            $product->stock -= $request->quantity;
        }
        $product->save();

        // Simpan catatan transaksi
        StockTransaction::create($request->all());

        return redirect()->route('stocks.index')->with('success', 'Transaksi stok berhasil dicatat!');
    }
    public function opnameCreate()
    {
        $products = Product::all();
        return view('stocks.opname', compact('products'));
    }

    public function opnameStore(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'physical_stock' => 'required|integer|min:0',
            'notes' => 'required|string',
        ]);

        $product = Product::findOrFail($request->product_id);
        $oldStock = $product->stock;
        $newStock = $request->physical_stock;
        
        $difference = $newStock - $oldStock;

        if ($difference === 0) {
            return redirect()->route('stocks.index')->with('success', 'Stok fisik sesuai dengan sistem. Tidak ada perubahan.');
        }

        $type = $difference > 0 ? 'in' : 'out';
        $quantity = abs($difference);

        $product->stock = $newStock;
        $product->save();

        StockTransaction::create([
            'product_id' => $product->id,
            'type' => $type,
            'quantity' => $quantity,
            'notes' => 'STOK OPNAME: ' . $request->notes . ' (Sistem: ' . $oldStock . ' -> Fisik: ' . $newStock . ')'
        ]);

        return redirect()->route('stocks.index')->with('success', 'Stok Opname berhasil direkonsiliasi!');
    }
}