<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restaurant>
 */
class RestaurantFactory extends Factory
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
            'description' => fake()->text(),
            'image' => "restaurant_pics/BmBUAbikJPLiZ8cQzZibxj6dVp3bxOeXGQpAaP0U.webp",
            'website' => fake()->url(),
            'email' => fake()->unique()->safeEmail(),
            'user_id' => fake()->numberBetween(1, 5),
            'address' => fake()->address(),
            'city' => fake()->city(),
            'phone' => fake()->phoneNumber(),
        ];
    }
}
