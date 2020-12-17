<?php

namespace App\Services\Category;

use App\Repositories\Category\CategoryRepositoryInterface;

class CategoryService implements CategoryRepositoryInterface
{
    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
}