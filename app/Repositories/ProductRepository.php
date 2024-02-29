<?php


namespace App\Repositories\ProductRepository;
use App\Models\Product;

class ProductRepository{
    protected $entity;

    public function __construct(Product $product) {
        $this->entity = $product;
    }

    public function getAllProducts() {
        return $this->entity->orderBy('id')->get();
    }

}