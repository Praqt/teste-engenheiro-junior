<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Client;
use App\Models\Product;
use Illuminate\Support\Str;
use Faker\Factory as FakerFactory;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create();

        $numberOfOrders = 10;

        $clients = Client::all();
        $products = Product::all();

        for ($i = 0; $i < $numberOfOrders; $i++) {
            $uuid = Str::uuid();

            // Get a random client
            $client = $clients->random();

            $status = $faker->randomElement(['Em Aberto', 'Pago', 'Cancelado']);

            $randomProducts = $products->random(mt_rand(1, 5));

            $productsArray = $randomProducts->map(function ($product) use ($faker) {
                return [
                    'uuid' => $product->uuid,
                    'name' => $product->name,
                    'quantity' => $faker->numberBetween(1, 10),
                ];
            })->toArray();

            $productsJson = json_encode($productsArray);

            Order::create([
                'uuid' => $uuid,
                'client_uuid' => $client->uuid,
                'status' => $status,
                'products' => $productsJson, // Insert the JSON-encoded string
            ]);
        }
    }
}
