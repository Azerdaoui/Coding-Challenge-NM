<?php

namespace App\Console\Commands\Product;

use Illuminate\Http\Request;
use Illuminate\Console\Command;

use App\Services\Product\ProductService;
use App\Repositories\Product\ProductRepository;

use Illuminate\Support\Facades\Validator;
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
    public function __construct(ProductService $productService)
    {        
        parent::__construct();

        $this->productService = $productService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $dataProduct = $this->askForProductDetails();

        $this->productService->store($dataProduct);
    
        $this->info('Product was created successfully');

        return 0;       
    }

    public function askForProductDetails(): array
    {
        $name  = $this->ask('Product name');
        $price = $this->ask('Product price');
        $categoryId  = $this->ask('Product category');
        $description = $this->ask('Product description');
        $imageUrl    = $this->ask('Product image URL');

        return array(
            'name'  => $name,  
            'price' => $price,  
            'categoryId' => $categoryId,  
            'description' => $description,
            'image' => $imageUrl != null ? $this->createUploadedFileObject($imageUrl) : null
        );
    }

    public function createUploadedFileObject(string $imageUrl): ?UploadedFile
    {
        return new UploadedFile($imageUrl, pathinfo($imageUrl)['basename'], filesize($imageUrl), true, true);
    }
}