<?php

namespace App\Http\Controllers\Api;

use App\DTO\Client\CreateClientDTO;
use App\DTO\Client\UpdateClientDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateClientRequest;
use App\Http\Resources\ClientResource;
use App\Services\ClientService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClientController extends Controller
{
    public function __construct(protected ClientService $service)
    {}
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $clients = $this->service->getAll($request->filter);
        
        return $clients;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateClientRequest $request)
    {
        $client = $this->service->new(CreateClientDTO::fromRequest($request));
        
        return new ClientResource($client);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(!$client = $this->service->findOne($id)) {
            return response()->json([
                "error" => "Not Found"
            ], Response::HTTP_NOT_FOUND);
        }
        
        return new ClientResource($client);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateClientRequest $request, string $id)
    {
        $client = $this->service->update(UpdateClientDTO::fromRequest($request, $id));
        
        if(!$client) {
            return response()->json([
                "error" => "Not Found"
            ], Response::HTTP_NOT_FOUND);
        }
        
        return new ClientResource($client);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(!$client = $this->service->findOne($id)) {
            return response()->json([
                "error" => "Not Found"
            ], Response::HTTP_NOT_FOUND);
        }
        
        $this->service->delete($id);
        
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
