<?php

namespace Database\Factories;

use App\Enums\PaymentStatus;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $client_id = Client::factory()->create()->id;

        return [
            "total_price" => $this->faker->randomNumber(8, false) + 1,
            "status" => $this->faker->randomElement(array_column(PaymentStatus::cases(), "name")),
            "client_id" => $client_id,
        ];
    }
}
