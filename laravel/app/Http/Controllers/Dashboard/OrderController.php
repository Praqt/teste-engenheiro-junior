<?php

namespace App\Http\Controllers\Dashboard;

use App\DTO\Order\CreateOrderDTO;
use App\DTO\Order\UpdateOrderDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateOrderRequest;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function __construct(protected OrderService $service)
    {}
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = $this->service->getAll();
        
        return Inertia::render("Dashboard/Orders/Index", [
            "orders" => $orders,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render("Dashboard/Orders/Form");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateOrderRequest $request, string $client_id)
    {
        $this->service->new(CreateOrderDTO::fromRequest($request, $client_id));
        
        return redirect()->route("dashboard.orders");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(!$order = $this->service->findOne($id)) {
            return back();
        }
        
        return Inertia::render("Dashboard/Orders/Show", [
            "order" => $order
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(!$order = $this->service->findOne($id)) {
            return back();
        }
        
        return Inertia::render("Dashboard/Orders/Form", [
            "order" => $order
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateOrderRequest $request, string $id)
    {
        $order = $this->service->update(UpdateOrderDTO::fromRequest($request, $id));

        if(!$order) {
            return back();
        }
        
        return redirect()->route("dashboard.orders");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->service->delete($id);

        return redirect()->route("dashboard.orders");
    }
}
