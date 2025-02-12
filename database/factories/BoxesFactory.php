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
            'adress' => $this->faker->address(),
            'number' => $this->faker->unique()->bothify('??-###'),
            'size' => $this->faker->randomFloat(2, 1, 100), 
        ];
    }
}
