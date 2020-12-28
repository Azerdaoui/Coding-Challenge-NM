<?php

namespace App\Console\Commands\Category;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use App\Services\Category\CategoryService;

class DeleteCategory extends Command
{
    private $categoryService;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:category';

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
        
        $this->categoryService->deleteCategoryCLI($data);
            
        $this->info('Category was deleted successfully');

        return 0;
    }

    public function askForDetails(): array
    {
        $categoryId = $this->ask('Category ID');

        return array(
            'categoryId' => $categoryId,
        );
    }
}
