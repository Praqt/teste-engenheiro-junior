<?php

namespace App\Http\Controllers\Dashboard;

use App\DTO\Client\CreateClientDTO;
use App\DTO\Client\UpdateClientDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateClientRequest;
use App\Services\ClientService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClientController extends Controller
{
    public function __construct(protected ClientService $service)
    {}
        

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = $this->service->getAll();

        return Inertia::render("Dashboard/Clients/Index", [
            "clients" => $clients
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render("Dashboard/Clients/Form");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateClientRequest $request)
    {
        $this->service->new(CreateClientDTO::fromRequest($request));
        
        return redirect()->route("dashboard.clients");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(!$client = $this->service->findOne($id)) {
            return back();
        }
        
        return Inertia::render("Dashboard/Clients/Show", [
            "client" => $client
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(!$client = $this->service->findOne($id)) {
            return back();
        }
        
        return Inertia::render("Dashboard/Clients/Form", [
            "client" => $client
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateClientRequest $request, string $id)
    {
        $client = $this->service->update(UpdateClientDTO::fromRequest($request, $id));

        if(!$client) {
            return back();
        }
        
        return redirect()->route("dashboard.clients");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->service->delete($id);

        return redirect()->route("dashboard.clients");
    }
}
