<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Pedido;
use App\Models\Produto;
use App\Models\Cliente;

class PedidoFactory extends Factory
{
    protected $model = Pedido::class;

    public function definition()
    {
        $produtoIds = Produto::pluck('uuid')->toArray();

        return [
            'uuid' => Str::uuid(),
            'produtos' => json_encode($this->faker->randomElements($produtoIds, $this->faker->numberBetween(1, 5))),
            'cliente_uuid' => Cliente::factory()->create()->uuid,
            'status' => $this->faker->randomElement(['Em Aberto', 'Pago', 'Cancelado']),
        ];
    }
}
