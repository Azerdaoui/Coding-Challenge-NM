<?php

namespace App\Http\Services\Product;

use App\Http\Repositories\Product\ProductRepository;

class ProductService
{
    private $productRepository;

    public function __construct()
    {
        $this->productRepository = new ProductRepository();
    }

    public function index($request)
    {
        return $this->productRepository->allProducts($request);
    }

    public function store($request)
    {
        return $this->productRepository->store($request);
    }

    public function destroy($request)
    {
        $this->productRepository->destroy($request);
    }
}