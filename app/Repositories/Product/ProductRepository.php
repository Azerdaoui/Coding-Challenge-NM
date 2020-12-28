<?php

namespace App\Repositories\Product;

use App\Models\Product;

use Illuminate\Http\Request;

class ProductRepository 
{

    public function allProducts(Request $request)
    {
        $sortBy = $request->sortBy;
        $categoryId = $request->categoryId;

        if($sortBy === null){
            $sortBy = "created_at";
        }   
        
        $query = Product::orderBy($sortBy, 'DESC')->with('category');

        if($categoryId != null) {
            $query->where(function($query) use ($categoryId){
                $query->where('category_id', $categoryId);
            });
        }

        $products = $query->get();

        return response()->json([
            'products' => $products
        ]);
    }

    public function store(array $data)
    {
        $product = new Product();

        $product->name  = $data['name'];
        $product->price = $data['price'];
        $product->category_id = $data['categoryId'];
        $product->description = $data['description'];
        if(isset($data['image'])) {
            $product->image = $data['image'];
        }
        
        $product->save();
    }

    public function destroy(array $data)
    {
        $product = Product::findOrFail($data['productId']);

        $product->delete();
    }

    public function findOrFail(int $productId): Product
    {
        return Product::findOrFail($productId);
    }
}