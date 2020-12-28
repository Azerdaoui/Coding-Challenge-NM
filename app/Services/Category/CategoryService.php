<?php

namespace App\Services\Category;

use App\Rules\Category\CheckCategory;
use App\Repositories\Category\CategoryRepository;

use Illuminate\Support\Facades\Validator;

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

    public function createCategoryCLI(array $data)
    {
        $this->validatorCreateCategory($data);
        
        $this->categoryRepository->store($data);
    }

    public function deleteCategoryCLI(String $name)
    {
        $this->categoryRepository->destroy($name);
    }

    public function validatorCreateCategory(array $data)
    {
        $validator = Validator::make($data, [
            'categoryName' => ['required', 'string', 'max:255'],
            'parentId' => ['nullable', 'numeric', new CheckCategory()]
        ]);

        if($validator->fails()) {
            throw new InvalidArgumentException($validator->errors());
        }
    }
}