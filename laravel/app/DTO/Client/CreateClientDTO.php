<?php

namespace App\DTO\Client;

use App\Http\Requests\StoreUpdateClientRequest;

class CreateClientDTO
{
    public function __construct(
        public string $email,
        public string $name,
        public string $phone_number,
    )
    {
        
    }
    
    public static function fromRequest(StoreUpdateClientRequest $request): self 
    {
        return new self(
            $request->email,
            $request->name,
            $request->phone_number
        );
    }
}