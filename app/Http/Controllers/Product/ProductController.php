<?php

namespace App\Http\Controllers\Product;

use Throwable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Product\ProductService;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        return $this->productService->index($request);
    }

    public function store(Request $request): JsonResponse
    {
        $statusCode = 200;

        try {
            $this->productService->store($request->all());

            $response = [
                'success' => true
            ];
        } catch (Throwable $th) {
            $statusCode = 500;
            $response = [
                'success' => false,
                'error' => $th->getMessage()
            ];
        }

        return response()->json($response, $statusCode);
    }
}