<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'], // cek apakah sudah ada
            [
                'name' => 'Administrator',
                'email' => 'admin@example.com',
                'password' => 'password123',
                'role' => 'admin',
            ]
        );
    }
}
