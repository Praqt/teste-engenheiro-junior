<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'cliente_uuid',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($pedido) {
            $pedido->uuid = Str::uuid();
        });
    }

    public function produtos()
    {
        return $this->belongsToMany(Produto::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_uuid', 'uuid');
    }
}
