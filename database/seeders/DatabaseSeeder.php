<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ✅ Insert Admin User (if not existing)
        User::updateOrCreate(
            ['email' => 'admin123@mail.com'], // Check if admin already exists
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'), // Securely hashed password
                'is_admin' => 1, // Make sure 'is_admin' field exists in users table
                'email_verified_at' => now(), // Email marked as verified
            ]
        );

        // ✅ Call other seeders to populate data
        $this->call([
            GenreSeeder::class,
            MovieSeeder::class,
            ReviewSeeder::class,
            CommentSeeder::class,
            UserSeeder::class, // Optional: Add this if you want random users (see below)
        ]);
    }
}
