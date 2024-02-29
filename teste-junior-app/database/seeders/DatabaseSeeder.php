<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::factory()->count(10)->create();
        $this->call(ClientesSeeder::class);
        $this->call(ProdutosSeeder::class);
        $this->call(PedidosSeeder::class);
    }
}
