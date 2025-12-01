<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Finance>
 */
class FinanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => fake()->randomElement(['income', 'expense']),
            'amount' => fake()->numberBetween(10000, 1000000),
            'description' => fake()->sentence(),
            'date' => fake()->date(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
