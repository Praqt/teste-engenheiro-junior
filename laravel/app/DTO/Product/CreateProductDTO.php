<?php

namespace App\DTO\Product;

use App\Http\Requests\StoreUpdateProductRequest;

class CreateProductDTO
{
    public function __construct(
        public string $name,
        public int $price,
        public int $stock,
    )
    {
        
    }
    
    public static function fromRequest(StoreUpdateProductRequest $request): self 
    {
        $normalizedPrice = 0;

        $pricesArray = preg_split("/\.|,/", $request->price);
        if(count($pricesArray) === 1) {
            $normalizedPrice = ((int) $pricesArray[0]) * 100;
        }
        else {
            $normalizedPrice = $pricesArray[0] * 100 + $pricesArray[1];
        }

        return new self(
            $request->name,
            $normalizedPrice,
            $request->stock,
        );
    }
}