<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', // Ditambahkan agar kode produk bisa tersimpan
        'name',
        'price',
        'stock',
        'category_id',
        'supplier_id',
        'size',   // <-- Ditambahkan untuk ukuran
        'color',  // <-- Ditambahkan untuk warna
    ];

    public function stockTransactions()
    {
        return $this->hasMany(StockTransaction::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}