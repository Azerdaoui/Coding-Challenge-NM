<?php

namespace App\Rules\Category;

use App\Models\Category;
use Illuminate\Contracts\Validation\Rule;
use App\Repositories\Category\CategoryRepository;

class CheckCategory implements Rule
{
    protected $categoryRepository;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {         
        return $this->categoryRepository->findOrFail($value)->id === (int) $value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The Category id is invalid.';
    }
}
