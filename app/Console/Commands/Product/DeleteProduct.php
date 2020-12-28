<?php

namespace App\Console\Commands\Product;

use Illuminate\Console\Command;
use App\Services\Product\ProductService;

use Illuminate\Support\Facades\Validator;
use App\Repositories\Product\ProductRepository;

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
        
        $this->productService = new ProductService(new ProductRepository());
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data = $this->askForProductId();

        $this->productService->destroy($data);

        $this->info('Product was deleted successfully');
    
        return 0;
    }

    public function askForProductId(): array
    {
        $productId = $this->ask('Product id:');

        return array(
            'productId' => $productId
        );
    }
}
