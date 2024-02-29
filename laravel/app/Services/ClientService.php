<?php

namespace App\Services;

use App\DTO\Client\CreateClientDTO;
use App\DTO\Client\UpdateClientDTO;
use App\Models\Client;
use stdClass;

class ClientService
{
    public function __construct(protected Client $model) {}


    public function getAll(): array
    {
        return $this->model
                    ->filter()
                    ->get()
                    ->toArray();
    }
    
    public function findOne(string $id): stdClass | null
    {
        $client = $this->model->find($id);

        if (!$client) {
            return null;
        }
        
        return (object) $client->toArray();
    }
    
    public function new(CreateClientDTO $dto): stdClass
    {
        $client = $this->model->create((array) $dto);
        return (object) $client->toArray();
    }
    
    public function update(UpdateClientDTO $dto): stdClass | null
    {
        if(!$client = $this->model->find($dto->id)) {
            return null;
        }
        
        $client->update((array) $dto);
        
        return (object) $client->toArray();
    }
    
    public function delete(string $id): void
    {
        $this->model->findOrFail($id)->delete();
    }
    
    public function getOrders(string $id): array | null
    {
        if(!$client = $this->model->find($id)) {
            return null;
        }
        
        return $client->orders()->get()->toArray();
    }
}