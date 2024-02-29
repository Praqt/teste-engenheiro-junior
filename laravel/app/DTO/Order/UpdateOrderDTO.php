<?php

namespace App\DTO\Order;

use App\Http\Requests\StoreUpdateOrderRequest;

class UpdateOrderDTO
{
    public function __construct(
        public string $id,
        public string $status,
        public int $total_price
    )
    {
        
    }
    
    public static function fromRequest(StoreUpdateOrderRequest $request, $id): self 
    {
        return new self(
            $id,
            $request->status,
            $request->total_price
        );
    }
}