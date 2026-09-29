<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    protected $productRepo;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function getAllProducts()
    {
        return $this->productRepo->getAll();
    }

    public function storeProduct(array $data)
    {
        // Tempat logika bisnis (misal validasi stok, hitung pajak, dll)
        return $this->productRepo->create($data);
    }
}