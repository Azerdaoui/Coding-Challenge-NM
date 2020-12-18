<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Services\Product\ProductService;

use Illuminate\Support\Facades\Validator;

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
        $id = $this->ask('Product id:');

        $data = array(
            'id'  => $id,  
        );
    
        $rules = array(
            'id' => 'required|numeric', 
        );
    
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) 
        {
            $messages = $validator->messages();

            $this->info($messages);
        }
        else
        {
            $this->productService->destroy($id);
        
            $this->info('Product was deleted successfully');
    
            return 0;
        } 


    }
}
