<?php

namespace App\Http\Services\Category;

use Intervention\Image\ImageManager;
use App\Http\Repositories\Category\CategoryRepository;

class CategoryService
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllCategories()
    {
        return $this->categoryRepository->all();
    }
}