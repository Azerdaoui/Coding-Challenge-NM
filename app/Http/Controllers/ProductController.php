<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Services\Product\ProductService;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function store(StoreProductRequest $request)
    {
        try 
        {
            $post = $this->productService->store($request);

            return [
                'success' => true
            ];
        } 
        catch (\Throwable $th) 
        {
            return [
                'success' => false,
                'error' => $th->getMessage()
            ];
        }
    }
}
