<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
// use App\Repositories\ProductRepository\ProductRepository;
// use App\Services\ProductService\ProductService
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $product;

    public function __construct(Product $product){
        $this->product = $product;
    }

    public function getProductsList() {
        return ProductResource::collection($this->product->getAllProducts());
    }
    
    public function create(Request $request) {
        return $this->product->createProduct($request->all());
    }

    public function delete($id) {
        return $this->product->deleteProduct($id);
    }

    public function update($id, Request $request) {
        return $this->product->updateProduct($id, $request->all());
    }

}
