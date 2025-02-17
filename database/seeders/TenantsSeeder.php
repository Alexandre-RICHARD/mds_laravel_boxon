<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tenants;

class TenantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tenants::factory(20)->create();
    }
}
