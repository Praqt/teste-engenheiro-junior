<?php

namespace App\Http\Controllers\Dashboard;

use App\DTO\Product\CreateProductDTO;
use App\DTO\Product\UpdateProductDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProductRequest;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function __construct(protected ProductService $service)
    {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = $this->service->getAll($request->filter);
        
        return Inertia::render("Dashboard/Products/Index", [
            "products" => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render("Dashboard/Products/Form");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateProductRequest $request)
    {
        $this->service->new(CreateProductDTO::fromRequest($request));
        
        return redirect()->route("dashboard.products");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(!$product = $this->service->findOne($id)) {
            return back();
        }
        
        return Inertia::render("Dashboard/Products/Show", [
            "product" => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(!$product = $this->service->findOne($id)) {
            return back();
        }
        
        $product->price = number_format($product->price / 100, 2, ".", "");
        
        return Inertia::render("Dashboard/Products/Form", [
            "product" => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateProductRequest $request, string $id)
    {
        $product = $this->service->update(UpdateProductDTO::fromRequest($request, $id));

        if(!$product) {
            return back();
        }
        
        return redirect()->route("dashboard.products");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->service->delete($id);

        return redirect()->route("dashboard.products");
    }
}
