<?php

namespace App\Repositories\Category;

use App\Models\Category;

class CategoryRepository
{
    public function all()
    {
        return Category::latest()->get();
    }

    public function store(String $name, int $parent_id=null)
    {
        // dd($name, $parent_id);

        $category = new Category();

        $category->name = $name;
        $category->parent_id = $parent_id;

        $category->save();

        // Category::create([
        //     'name' => $name,
        //     'parent_id' => $parent_id
        // ]);
    }

    public function destroy(String $name)
    {
        Category::where('name', $name)->delete();
    }

    public function findOrFail(int $productId): Category
    {
        return Category::findOrFail($productId);
    }
}