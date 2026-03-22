<?php

/**
 * Author: Juan Esteban Trujillo Montes
 * Description: Factory responsible for generating fake data for Orders
 */

namespace Database\Factories;

use App\Models\User;
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
        $status = fake()->randomElement(['pending', 'completed', 'cancelled']);

        return [
            'user_id' => User::factory(),
            'total' => 0,
            'status' => $status,
            'can_be_cancelled' => $status === 'pending',
        ];
    }
}
