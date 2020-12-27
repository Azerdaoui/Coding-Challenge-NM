<?php

namespace App\Console\Commands\Product;

// use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Console\Command;

use App\Services\Product\ProductService;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Product\ProductRepository;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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

        $this->productService = new ProductService(new ProductRepository());
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name  = $this->ask('Product name');
        $price = $this->ask('Product price');
        $category_id = $this->ask('Product category');
        $description = $this->ask('Product description');
        $imageUrl = $this->ask('Product image URL');

        $dataProduct = array(
            'name'  => $name,  
            'price' => $price,  
            'categoryId' => $category_id,  
            'description' => $description,
            'image' => $this->createUploadedFile($imageUrl)
        );

        $this->productService->store($dataProduct);
    
        $this->info('Product was created successfully');

        return 0;       
    }

    public function createUploadedFile(string $imageUrl)
    {
        return new UploadedFile($imageUrl, pathinfo($imageUrl)['basename'], filesize($imageUrl), true, true);
    }
}