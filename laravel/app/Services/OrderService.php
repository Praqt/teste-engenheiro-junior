<?php

namespace App\Services;

use App\DTO\Order\CreateOrderDTO;
use App\DTO\Order\UpdateOrderDTO;
use App\Models\Client;
use App\Models\Order;
use stdClass;

class OrderService
{
    public function __construct(protected Order $model) {}


    public function getAll(): array
    {
        return $this->model
                    ->filter()
                    ->get()
                    ->toArray();
    }

    public function findOne(string $id): stdClass | null
    {
        $order = $this->model->find($id);

        if (!$order) {
            return null;
        }

        return (object) $order->toArray();
    }

    public function new(CreateOrderDTO $dto): stdClass
    {
        $order = $this->model->create((array) $dto);
        return (object) $order->toArray();
    }

    public function update(UpdateOrderDTO $dto): stdClass | null
    {
        if(!$order = $this->model->find($dto->id)) {
            return null;
        }

        $order->update((array) $dto);

        return (object) $order->toArray();
    }

    public function delete(string $id): void
    {
        $this->model->findOrFail($id)->delete();
    }
    
    public function getClient($id): stdClass | null {
        if (!$order = $this->model->find($id)) {
            return null;
        }

        if(!$client = Client::find($order->getAttribute("client_id")))
        {
            null;
        }
        return (object) $client->toArray();
    }
}
