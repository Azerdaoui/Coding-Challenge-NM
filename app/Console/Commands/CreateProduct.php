<?php

namespace App\Console\Commands;

use Illuminate\Http\Request;
use Illuminate\Console\Command;
use App\Http\Services\Product\ProductService;

class CreateProduct extends Command
{

    private $productService;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Product';

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
        $name  = $this->ask('Product name:');
        $price = $this->ask('Product price:');
        $category_id = $this->ask('Product category:');
        $description = $this->ask('Product description:');

        $data = [
            'name'  => $name,  
            'price' => $price,  
            'category_id' => $category_id,  
            'description' => $description,  
        ];

        $this->productService->store(new Request($data));

        $this->info('Product was created successfully');

        return 0;
    }
}
