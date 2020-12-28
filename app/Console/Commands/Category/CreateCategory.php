<?php

namespace App\Console\Commands\Category;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

use App\Services\Category\CategoryService;

class CreateCategory extends Command
{
    private $categoryService;

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
    public function __construct(CategoryService $categoryService)
    {
        parent::__construct();

        $this->categoryService = $categoryService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data = $this->askForDetails();

        $this->categoryService->createCategoryCLI($data);
            
        $this->info('Category was created successfully');
        
        return 0;
    }

    public function askForDetails(): array
    {
        $parentId = null;
        $categoryName = $this->ask('Category name');
        
        if ($this->confirm('This category have a parent?')) {
            $parentId = $this->ask('Category parent_id');
        }

        return array(
            'categoryName' => $categoryName,
            'parentId' => $parentId
        );
    }
}
