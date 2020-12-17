<?php

namespace App\Http\Repositories\Product;

use Image;

use App\Models\Product;

use Illuminate\Support\Str;

class ProductRepository 
{
    private $images_link = 'storage/images/';

    public function store($request)
    {
        // dd($request->all());

        return Product::create([
            'name'  => $request->name,
            'price' => $request->price,
            'image' => $this->uploadImage($request),
            'category_id' => $request->category_id,
            'description' => $request->description,
        ]);
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
}