<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function getAll()
    {
        return Product::latest()->get();
    }

    public function create(array $data)
    {
        return Product::create($data);
    }
}