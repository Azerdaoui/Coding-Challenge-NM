<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\Category\CategoryService;

class DeleteCategory extends Command
{
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

        $data = array(
            'category_name' => $category_name,
        );
    
        $rules = array(
            'category_name' => 'required|string',
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
            
            $categoryService->deleteCategoryCLI($category_name);
            
            $this->info('Category was deleted successfully');
        }

        return 0;




        return 0;
    }
}
