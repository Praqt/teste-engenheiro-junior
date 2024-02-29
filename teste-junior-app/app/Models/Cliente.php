<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'nome',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($cliente) {
            $cliente->uuid = Str::uuid();
        });
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}
