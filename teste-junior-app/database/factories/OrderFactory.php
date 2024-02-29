<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\Product;
use App\Models\Client;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        $productIds = Product::pluck('uuid')->toArray();

        return [
            'uuid' => Str::uuid(),
            'products' => json_encode($this->faker->randomElements($productIds, $this->faker->numberBetween(1, 5))),
            'client_uuid' => Client::factory()->create()->uuid,
            'status' => $this->faker->randomElement(['Em Aberto', 'Pago', 'Cancelado']),
        ];
    }
}
