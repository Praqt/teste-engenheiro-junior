<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'nome',
        'descricao',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($produto) {
            $produto->uuid = Str::uuid();
        });
    }

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

}
