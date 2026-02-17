<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@example.it'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'is_admin' => true,
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@example.it'],
            [
                'name' => 'Regular User',
                'password' => Hash::make('password'),
                'is_admin' => false,
            ]
        );
    }
}