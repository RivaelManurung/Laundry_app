<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Package>
 */
class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = ['kiloan', 'satuan'];
        $units = ['kg', 'pcs', 'set'];
        
        return [
            'name' => fake()->words(2, true),
            'type' => fake()->randomElement($types),
            'price' => fake()->numberBetween(5000, 50000),
            'unit' => fake()->randomElement($units),
            'description' => fake()->sentence(),
        ];
    }
}
