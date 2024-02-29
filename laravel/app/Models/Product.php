<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mehradsadeghi\FilterQueryString\FilterQueryString;

class Product extends Model
{
    use HasFactory, FilterQueryString;
    
    protected $filters = [
        "sort",
        "like"
    ];
    
    protected $fillable = [
        "name",
        "price",
        "stock"
    ];

    public function orders() {
        return $this->belongsToMany("App\Model\Order");
    }
}
