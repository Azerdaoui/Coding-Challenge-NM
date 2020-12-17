<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Category\CategoryService;

class CategoryController extends Controller
{
    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function allCategories()
    {
        return $this->categoryService->getAllCategories();
    }
}
