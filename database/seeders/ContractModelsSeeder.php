<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContractModels;

class ContractModelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContractModels::factory()->create([
            'name' => 'Modèle de contrat par défaut',
            'content' => '',
            'user_id' => 1,
        ]);
        ContractModels::factory()->create([
            'name' => 'Modèle de contrat par défaut',
            'content' => '',
            'user_id' => 2,
        ]);
        ContractModels::factory(0)->create();
    }
}
