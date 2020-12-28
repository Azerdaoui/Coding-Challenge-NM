<?php

namespace App\Services\Product;

use Image;
use Throwable;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use InvalidArgumentException;
use App\Rules\Product\CheckProduct;
use App\Rules\Category\CheckCategory;

use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Repositories\Product\ProductRepository;

class ProductService
{
    private $productRepository;

    private $imagesLink = 'storage/images/';

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index(Request $request)
    {
        return $this->productRepository->allProducts($request);
    }

    public function store(array $data)
    {        
        $this->validatorStoreProduct($data);

        if(isset($data['image'])) {
            $imageUrl = $this->uploadImage($data['image']);
            $data['image'] = $imageUrl;
        }

        $this->productRepository->store($data);
    }

    public function destroy(array $data)
    {
        $this->validatorDestroyProduct($data);

        $this->productRepository->destroy($data);
    }

    public function validatorDestroyProduct(array $data)
    {
        $validator = Validator::make($data, [
            'productId' => ['required', 'numeric', new CheckProduct()],
        ]);

        if($validator->fails()) {
            throw new InvalidArgumentException($validator->errors());
        }
    }

    public function validatorStoreProduct(array $data)
    {
        $validator = Validator::make($data, [
            'name'  => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'image.*' => ['nullable', 'image'],
            'categoryId' => ['required', 'numeric', new CheckCategory()],
            'description' => ['required', 'string', 'max:1000'],
        ]);

        if($validator->fails()) {
            throw new InvalidArgumentException($validator->errors());
        }
    }

    public function uploadImage($image): string
    {
        $imageName = Str::random(12) . '_' . time(). '.' . $image->getClientOriginalExtension();
        $path = public_path($this->imagesLink) . $imageName;

        $imageCreated = Image::make($image);
        $imageCreated->save($path);
        $imageCreated->destroy();

        return url($this->imagesLink . $imageName);
    }
}