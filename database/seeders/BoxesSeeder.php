<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Boxes;

class BoxesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Boxes::factory(20)->create();
    }
}
