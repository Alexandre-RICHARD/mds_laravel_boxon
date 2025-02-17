<?php

namespace Database\Factories;

use App\Models\User;
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
            'adress' => fake()->address(),
            'number' => fake()->unique()->bothify('###'),
            'size' => fake()->randomFloat(2, 1, 100), 
            'user_id' => User::pluck('id')->random(),
        ];
    }
}
