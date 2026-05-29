<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin Seeder
        User::create([
    'name' => 'Admin',
    'username' => 'admin',
    'email' => 'admin@gmail.com',
    'password' => Hash::make('password'),
    'role' => 'admin',
]);

        // Seeder lain
        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
        ]);
    }
}