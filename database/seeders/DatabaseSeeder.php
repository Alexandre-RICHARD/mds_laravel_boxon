<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            BoxesSeeder::class,
            TenantsSeeder::class,
            ContractModelsSeeder::class,
            ContractsSeeder::class,
            BillsSeeder::class,
        ]);
    }
}
