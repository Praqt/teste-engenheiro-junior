<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mehradsadeghi\FilterQueryString\FilterQueryString;

class Client extends Model
{
    use HasFactory, FilterQueryString;
    
    protected $filters = [
        "sort",
        "like"
    ];
    
    protected $fillable = [
        "name",
        "phone_number",
        "email"
    ];
    
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
