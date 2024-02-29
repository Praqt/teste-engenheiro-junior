<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\Produto;
use Illuminate\Support\Str;
use Faker\Factory as FakerFactory;

class PedidosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create();

        $numberOfPedidos = 10;

        $produtos = Produto::all();

        for ($i = 0; $i < $numberOfPedidos; $i++) {
            $uuid = Str::uuid();

            $clienteUuid = Cliente::inRandomOrder()->value('uuid');

            $status = $faker->randomElement(['Em Aberto', 'Pago', 'Cancelado']);

            $randomProdutos = $produtos->random(mt_rand(1, 5));

            $produtosJson = $randomProdutos->map(function ($produto) use ($faker) {
                return [
                    'uuid' => $produto->uuid,
                    'name' => $produto->nome,
                    'quantity' => $faker->numberBetween(1, 10),
                ];
            })->toJson();

            Pedido::create([
                'uuid' => $uuid,
                'cliente_uuid' => $clienteUuid,
                'status' => $status,
                'produtos' => $produtosJson,
            ]);
        }
    }
}
