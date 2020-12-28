<?php

namespace App\Repositories\Category;

use App\Models\Category;

class CategoryRepository
{
    public function all()
    {
        return Category::latest()->get();
    }

    public function store(array $data)
    {
        $category = new Category();

        $category->name = $data['categoryName'];
        $category->parent_id = $data['parentId'];

        $category->save();
    }

    public function destroy(String $name)
    {
        Category::where('name', $name)->delete();
    }

    public function findOrFail(int $categorytId): Category
    {
        return Category::findOrFail($categorytId);
    }
}