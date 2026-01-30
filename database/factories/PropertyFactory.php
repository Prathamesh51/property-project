<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence,
            'description' => fake()->paragraph,
            'type' => fake()->randomElement(['Apartment', 'House', 'Commercial']),
            'price' => fake()->numberBetween(500000, 60000000),
            'location' => fake()->address,
            'status' => fake()->randomElement(['Available','Sold']),
            'image' => null
        ];
    }
}
