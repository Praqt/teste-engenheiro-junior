<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;

class ClientesSeeder extends Seeder
{
    public function run()
    {
        // Create 10 clientes with dummy data
        Cliente::factory()->count(10)->create();
    }
}
