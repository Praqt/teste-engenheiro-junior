<?php

namespace App\Http\Controllers\Api;

use App\DTO\Order\CreateOrderDTO;
use App\DTO\Order\UpdateOrderDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateOrderRequest;
use App\Http\Resources\ClientResource;
use App\Http\Resources\OrderResource;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    public function __construct(protected OrderService $service)
    {}

    
    public function client(string $id)
    {
        if(!$client = $this->service->getClient($id)) {
            return response()->json([
                "error" => "Not Found"
            ], Response::HTTP_NOT_FOUND);
        }
        
        return new ClientResource($client);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order = $this->service->getAll();
        
        return $order;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateOrderRequest $request, string $id)
    {
        $order = $this->service->new(CreateOrderDTO::fromRequest($request, $id));
        
        return new OrderResource($order);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(!$order = $this->service->findOne($id)) {
            return response()->json([
                "error" => "Not Found"
            ], Response::HTTP_NOT_FOUND);
        }
        
        return new OrderResource($order);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateOrderRequest $request, string $id)
    {
        $order = $this->service->update(UpdateOrderDTO::fromRequest($request, $id));
        
        if(!$order) {
            return response()->json([
                "error" => "Not Found"
            ], Response::HTTP_NOT_FOUND);
        }
        
        return new OrderResource($order);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(!$order = $this->service->findOne($id)) {
            return response()->json([
                "error" => "Not Found"
            ], Response::HTTP_NOT_FOUND);
        }
        
        $this->service->delete($id);
        
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
