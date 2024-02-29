<?php

namespace App\DTO\Client;

use App\Http\Requests\StoreUpdateClientRequest;

class UpdateClientDTO
{
    public function __construct(
        public string $id,
        public string $email,
        public string $name,
        public string $phone_number,
    )
    {
        
    }

    public static function fromRequest(StoreUpdateClientRequest $request, string $id): self 
    {
        return new self(
            $id,
            $request->email,
            $request->name,
            $request->phone_number
        );
    }
}