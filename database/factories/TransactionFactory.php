<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'invoice_code' => 'TRX-' . fake()->unique()->numerify('#####'),
            'customer_id' => \App\Models\Customer::factory(),
            'user_id' => \App\Models\User::factory(),
            'total_amount' => fake()->numberBetween(20000, 200000),
            'status' => fake()->randomElement(['pending', 'processing', 'ready', 'done', 'cancelled']),
            'payment_status' => fake()->randomElement(['unpaid', 'paid']),
            'payment_method' => fake()->randomElement(['cash', 'transfer']),
            'paid_at' => fake()->dateTimeThisMonth(),
            'deadline' => fake()->dateTimeBetween('now', '+1 week'),
            'notes' => fake()->sentence(),
        ];
    }
}
