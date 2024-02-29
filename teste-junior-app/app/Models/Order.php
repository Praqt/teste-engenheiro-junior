<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'client_uuid',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->uuid = Str::uuid();
        });
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_uuid', 'uuid');
    }
}
