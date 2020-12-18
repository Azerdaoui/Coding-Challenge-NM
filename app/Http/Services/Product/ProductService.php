<?php

namespace App\Http\Services\Product;

use App\Http\Repositories\Product\ProductRepository;

class ProductService
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index($request)
    {
        return $this->productRepository->allProducts($request);
    }

    public function store($request)
    {
        return $this->productRepository->store($request);
    }
}