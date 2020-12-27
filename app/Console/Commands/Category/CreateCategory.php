<?php

namespace App\Console\Commands\Category;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use App\Services\Category\CategoryService;

class CreateCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:category';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a category';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $category_name  = $this->ask('Category name');
        $parent_id = $this->ask('Category parent_id');

        $data = array(
            'category_name' => $category_name,
            'parent_id'  => $parent_id
        );
    
        $rules = array(
            'category_name' => 'required|string',
            'parent_id'  => 'nullable|numeric',
        );
    
        $validator = Validator::make($data, $rules);
    
        if ($validator->fails()) 
        {
            $messages = $validator->messages();

            $this->info($messages);
        }
        else
        {
            $categoryService = new CategoryService();
            $categoryService->createCategoryCLI($category_name, $parent_id);
            
            $this->info('Category was created successfully');
        }

        return 0;
    }
}
