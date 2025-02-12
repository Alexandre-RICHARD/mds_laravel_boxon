<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BoxesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => random_int(1, 7),
            'adress' => fake()->name(),
            'number' => fake()->unique()->bothify('###'),
            'size' => fake()->randomFloat(2, 1, 100), 
        ];
    }
}
