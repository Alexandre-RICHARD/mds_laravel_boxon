<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contracts;

class ContractsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contracts::factory(20)->create();
    }
}
