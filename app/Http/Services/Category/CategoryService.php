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

    public function createCategoryCLI(String $name, int $parent_id=null)
    {
        $this->categoryRepository->store($name, $parent_id);
    }

    public function deleteCategoryCLI(String $name)
    {
        $this->categoryRepository->destroy($name);
    }
}