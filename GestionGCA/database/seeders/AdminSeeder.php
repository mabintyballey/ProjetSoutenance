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
                'name' => 'Mabinty Balley',
                'prenom' => 'Bangoura',
                'email' => 'admin@cabinet.com',
                'password' => Hash::make('password123'), 
                'role' => 'admin',
                'adresse' => 'Bureau Central',
                'is_active' => true,
                'photo' => 'admin.jpg',
                'statut_validation' => 'valide',
            ]
        );
    }
}
