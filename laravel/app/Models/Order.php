<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mehradsadeghi\FilterQueryString\FilterQueryString;

class Order extends Model
{
    use HasFactory, FilterQueryString;

    protected $filters = [
        "sort",
        "like"
    ];
    
    protected $fillable = [
        "total_price",
        "status",
        "client_id",
    ];
    
    public function client() {
        return $this->belongsTo(Client::class);
    }
    
    public function products() {
        return $this->belongsToMany("App\Model\Product");
    }
}
