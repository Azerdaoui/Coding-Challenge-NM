<?php

namespace App\Services\Product;

use App\Repositories\Category\CategoryRepositoryInterface;

class ProductService implements CategoryRepositoryInterface
{
    private $productRepository;

    public function __construct(CategoryRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }
}