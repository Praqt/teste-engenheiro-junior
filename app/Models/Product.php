<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'product_name',
        'description',
        'price'
    ];


    public function getAllProducts() {
        return $this->orderBy('id')->get();
    }

    public function createProduct($data) {
        return $this->create($data);
    }

    public function deleteProduct($id) {
        return $this->destroy($id);
    }

    public function updateProduct($id, $data) {
        $product = $this->find($id);
        
        $product->update($data);
        
        return $product;
    }
}
