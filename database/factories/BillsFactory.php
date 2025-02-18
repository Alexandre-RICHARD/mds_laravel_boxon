<?php

namespace Database\Factories;

use App\Models\Contracts;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BillsFactory extends Factory
{

    protected $model = \App\Models\Bills::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount' => fake()->randomFloat(2, 1, 100),
            'paiement_date' => fake()->date(),
            'bills_period' => fake()->date('Y-m-d', 'now'),
            'period_number' => fake()->random_int(1, 20),
            'contract_id' => Contracts::pluck('id')->random(),
        ];
    }
}
