<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Services\Product\ProductService;

class DeleteProduct extends Command
{
    
    private $productService;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete a Product';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->productService = new ProductService();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->ask('Product name:');

        $this->productService->destroy($name);
        
        $this->info('Product was deleted successfully');

        return 0;
    }
}
