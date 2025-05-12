<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@cabinet.com'],
            [
                'name' => 'Admin',
                'prenom' => 'Principal',
                'email' => 'admin@cabinet.com',
                'password' => Hash::make('password123'), // Change ça plus tard
                'role' => 'admin',
                'adresse' => 'Bureau Central',
                'is_active' => true,
                'statut_validation' => 'valide',
            ]
        );
    }
}
