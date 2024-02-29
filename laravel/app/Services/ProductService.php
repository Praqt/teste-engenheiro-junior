<?php

namespace App\Services;

use App\DTO\Product\CreateProductDTO;
use App\DTO\Product\UpdateProductDTO;
use App\Models\Product;
use stdClass;

class ProductService
{
    public function __construct(protected Product $model) {}
        

    public function getAll(string $filter = null): array
    {
        return $this->model
                    ->where(function($query) use ($filter) {
                        if($filter) {
                            $query->where("name", "like", "%{$filter}%");
                            $query->where("price", "like", "%{$filter}%");
                            $query->where("stock", "like", "%{$filter}%");
                        }
                    })
                    ->get()
                    ->toArray();
    }
    
    public function findOne(string $id): stdClass | null
    {
        $product = $this->model->find($id);

        if (!$product) {
            return null;
        }
        
        return (object) $product->toArray();
    }
    
    public function new(CreateProductDTO $dto): stdClass
    {
        $product = $this->model->create((array) $dto);
        return (object) $product->toArray();
    }
    
    public function update(UpdateProductDTO $dto): stdClass | null
    {
        if(!$product = $this->model->find($dto->id)) {
            return null;
        }
        
        $product->update((array) $dto);
        
        return (object) $product->toArray();
    }
    
    public function delete(string $id): void
    {
        $this->model->findOrFail($id)->delete();
    }
}