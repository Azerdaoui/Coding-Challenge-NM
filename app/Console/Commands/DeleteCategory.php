<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Services\Category\CategoryService;

class DeleteCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:category {category_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete a category';

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
        $category_name = $this->argument('category_name');

        $categoryService = new CategoryService();
        $categoryService->deleteCategoryCLI($category_name);
        
        $this->info('Category was deleted successfully');

        return 0;
    }
}
