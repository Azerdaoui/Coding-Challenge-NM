<?php

namespace Tests\Unit;

use  Tests\TestCase;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Http\Services\Product\ProductService;

class ProductTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $productService = new ProductService();

        $data = [
            'name' => 'othmane',
            'price' => 199,
            'category_id' => 1,
            'description' => 'description',
        ];

        $product = $productService->store(new Request($data));

        $this->assertEquals($product->name, 'othmane');
    }
}
