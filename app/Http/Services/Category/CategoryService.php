<?php

namespace App\Http\Services\Category;

use Intervention\Image\ImageManager;
use App\Http\Repositories\Category\CategoryRepository;

class CategoryService
{
    private $categoryRepository;

    public function __construct()
    {
        $this->categoryRepository = new CategoryRepository();
    }

    public function getAllCategories()
    {
        return $this->categoryRepository->all();
    }

    public function createCategoryCLI(String $name)
    {
        $this->categoryRepository->store($name);
    }
}