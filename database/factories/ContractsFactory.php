<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Tenants;
use App\Models\Boxes;
use App\Models\Contracts;
use App\Models\ContractModels;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ContractsFactory extends Factory
{
    protected $model = \App\Models\Contracts::class;
    protected static $usedBoxIds = [];
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userId = User::pluck('id')->random();

        $availableBoxIds = Boxes::where('user_id', $userId)->pluck('id')->diff(self::$usedBoxIds);
        if ($availableBoxIds->isEmpty()) {
            return null;
        }
        $boxId = $availableBoxIds->random();
        self::$usedBoxIds[] = $boxId;

        $availableTenantIds = Tenants::where('user_id', $userId)->pluck('id');
        if ($availableTenantIds->isEmpty()) {
            return null;
        }
        $tenantId = $availableTenantIds->random();

        $availableContractModelsIds = ContractModels::where('user_id', $userId)->pluck('id');
        if ($availableContractModelsIds->isEmpty()) {
            return null;
        }
        $contractModelId = $availableContractModelsIds->random();

        return [
            'date_start' => fake()->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
            'date_end' => fake()->dateTimeBetween('now', '+3 year')->format('Y-m-d'),
            'monthly_price' => fake()->randomFloat(2, 1, 1500), 
            'box_id' => $boxId,
            'tenant_id' => $tenantId,
            'user_id' => $userId,
            'contract_model_id' => $contractModelId,
        ];
    }
}
