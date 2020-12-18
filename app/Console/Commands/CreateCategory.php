<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Services\Category\CategoryService;

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

        // $category_name = $this->argument('category_name');
        // $parent_id = $this->argument('parent_id');

        $categoryService = new CategoryService();
        $categoryService->createCategoryCLI($category_name, $parent_id);
        
        $this->info('Category was created successfully');

        return 0;
    }
}
