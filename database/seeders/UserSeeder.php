<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      
      User::factory()->create([
        'name' => 'Alexandre',
        'email' => 'alexandre.richard@gmail.com',
      ]);
      User::factory()->create([
        'name' => 'Kévin',
        'email' => 'kevin.niel@gmail.com',
      ]);
      User::factory(0)->create();
    }
}
