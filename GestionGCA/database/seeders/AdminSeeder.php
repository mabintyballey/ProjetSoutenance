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
            ['email' => 'gescaguinee224@gmail.com'],
            [
                'nom' => 'DIENG',
                'prenom' => 'Amadou',
                'email' => 'gescaguinee224@gmail.com',
                'password' => Hash::make('password123'), 
                'role' => 'admin',
                'telephone'=>'623906351',
                'adresse' => 'Bureau Central',
                'photo' => 'admin.jpg',
            ]
        );
    }
}
