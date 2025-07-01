<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Seeders\SpecialiteSeeder as SeedersSpecialiteSeeder;
use Illuminate\Database\Seeder;
use SpecialiteSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            AdminSeeder::class,
            DomaineSeeder::class,
            SeedersSpecialiteSeeder::class
        ]);
    }
}
