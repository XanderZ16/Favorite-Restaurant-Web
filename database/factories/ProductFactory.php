<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->sentence(),
            'price' => fake()->numberBetween(10000, 50000),
            'image' => "product_pics\9J8nwhqLWwTjBHUHFKGqL7iV5f7meTomOnTqyAIM.webp",
            'restaurant_id' => fake()->numberBetween(1, 20),
        ];
    }
}
