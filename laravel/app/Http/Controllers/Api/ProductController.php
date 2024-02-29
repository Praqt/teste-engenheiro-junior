<?php

namespace App\Http\Controllers\Api;

use App\DTO\Product\CreateProductDTO;
use App\DTO\Product\UpdateProductDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function __construct(protected ProductService $service)
    {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->service->getAll();
        
        return $products;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateProductRequest $request)
    {
        $product = $this->service->new(CreateProductDTO::fromRequest($request));
        
        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(!$product = $this->service->findOne($id)) {
            return response()->json([
                "error" => "Not Found"
            ], Response::HTTP_NOT_FOUND);
        }
        
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateProductRequest $request, string $id)
    {
        $product = $this->service->update(UpdateProductDTO::fromRequest($request, $id));
        
        if(!$product) {
            return response()->json([
                "error" => "Not Found"
            ], Response::HTTP_NOT_FOUND);
        }
        
        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(!$product = $this->service->findOne($id)) {
            return response()->json([
                "error" => "Not Found"
            ], Response::HTTP_NOT_FOUND);
        }
        
        $this->service->delete($id);
        
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
