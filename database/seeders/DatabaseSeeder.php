<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Seeders\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            BoxesSeeder::class,
        ]);
    }
}
