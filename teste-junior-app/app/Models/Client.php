<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
        'email'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($client) {
            $client->uuid = Str::uuid();
        });
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
