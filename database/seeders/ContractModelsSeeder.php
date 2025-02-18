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
        $default_model = "Le {{ contract_creation_date }}, 

A été conclu que {{ tenant_name }} loue du {{ started_date }} au {{ end_date }} le bien immobilier se situant à l'adresse {{ box_adress }}. Ce bien, appartenant à {{ owner_name }} est distribué pour un loyer mensuel de {{ monthly_price }} €";

        ContractModels::factory()->create([
            'name' => 'Modèle de contrat par défaut',
            'content' => $default_model,
            'user_id' => 1,
        ]);
        ContractModels::factory()->create([
            'name' => 'Modèle de contrat par défaut',
            'content' => $default_model,
            'user_id' => 2,
        ]);
        ContractModels::factory(0)->create();
    }
}
