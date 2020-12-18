<?php

namespace App\Http\Repositories\Category;

use App\Models\Category;

class CategoryRepository
{
    public function all()
    {
        return Category::latest()->get();
    }

    public function store(String $name)
    {
        Category::create([
            'name' => $name
        ]);
    }
}