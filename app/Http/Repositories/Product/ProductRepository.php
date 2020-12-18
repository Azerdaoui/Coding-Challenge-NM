<?php

namespace App\Http\Repositories\Product;

use Image;

use App\Models\Product;

use Illuminate\Support\Str;

class ProductRepository 
{
    private $images_link = 'storage/images/';

    public function allProducts($request)
    {
        $sortBy = $request->sortBy;
        $category_id = $request->category_id;

        if($sortBy === null)
        {
            $sortBy = "created_at";
        }   
        
        $query = Product::orderBy($sortBy, 'DESC')->with('category');

        if($category_id != null){
            $query->where(function($query) use ($category_id){
                $query->where('category_id', $category_id);
            });
        }

        $products  = $query->get();

        return response()->json([
            'products' => $products,
        ]);
    }

    public function store($request)
    {
        $product = new Product();

        $product->name  = $request['name'];
        $product->price = $request['price'];
        is_object($request['image']) ? $product->image = $this->uploadImage($request) : $product->image = null;
        $product->category_id = $request['category_id'];
        $product->description = $request['description'];
        
        $product->save();

        return $product;
    }

    public function uploadImage($request)
    {
        $image    = $request->file('image');

        $image_name = Str::random(12) . '_' . time(). '.' . $image->getClientOriginalExtension();
        $path = public_path($this->images_link) . $image_name;

        $imageCreated = Image::make($image);
        $imageCreated->save($path);
        $imageCreated->destroy();

        return url($this->images_link . $image_name);
    }

    public function destroy($product_id)
    {
        $product = Product::findOrFail($product_id);

        $product->delete();
    }
}