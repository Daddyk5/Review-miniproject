<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ✅ Admin User
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('adminpassword'), // 🔑 password: adminpassword
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );

        // ✅ Normal User
        User::updateOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Normal User',
                'password' => Hash::make('userpassword'), // 🔑 password: userpassword
                'is_admin' => false,
                'email_verified_at' => now(),
            ]
        );
    }
}
