<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
        'descricao',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $product->uuid = Str::uuid();
        });
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
