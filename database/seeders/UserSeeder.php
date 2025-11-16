<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Primary admin / owner account
        User::updateOrCreate(
            ['email' => 'admin@knightcrm.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // Extra demo accounts for testing
        User::updateOrCreate(
            ['email' => 'freelancer@knightcrm.com'],
            [
                'name' => 'Freelancer Demo',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'viewer@knightcrm.com'],
            [
                'name' => 'Viewer Demo',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
    }
}

