<?php

namespace App\DTO\Order;

use App\Http\Requests\StoreUpdateOrderRequest;

class CreateOrderDTO
{
    public function __construct(
        public string $status,
        public int $total_price,
        public string $client_id
    )
    {
        
    }
    
    public static function fromRequest(StoreUpdateOrderRequest $request, string $client_id): self 
    {
        return new self(
            $request->status,
            $request->total_price,
            $client_id
        );
    }
}