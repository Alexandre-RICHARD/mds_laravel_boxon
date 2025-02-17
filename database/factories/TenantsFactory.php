<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TenantsFactory extends Factory
{
    protected $model = \App\Models\Tenants::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
          'name' => fake()->name(),
          'email' => fake()->email(),
          'phone' => fake()->phoneNumber(),
          'adress' => fake()->address(),
          'user_id' => User::pluck('id')->random(),
        ];
    }
}
