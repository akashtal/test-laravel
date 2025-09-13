<?php

namespace Database\Seeders;

use App\Models\UserMaster;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create test users
        UserMaster::create([
            'name' => 'Admin User',
            'username' => 'admin',
            'phone' => '1234567890',
            'password' => Hash::make('password'),
            'role' => 'Admin',
        ]);

        UserMaster::create([
            'name' => 'Employee User',
            'username' => 'employee',
            'phone' => '0987654321',
            'password' => Hash::make('password'),
            'role' => 'Employee',
        ]);
    }
}
