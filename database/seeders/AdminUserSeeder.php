<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $email = env('ADMIN_EMAIL', 'hmforkan99@gmail.com');
        $password = env('ADMIN_PASSWORD');

        if (empty($password)) {
            $this->command?->warn('ADMIN_PASSWORD not set in .env — skipping admin user creation. Set ADMIN_EMAIL and ADMIN_PASSWORD to provision an admin.');
            return;
        }

        if (User::where('email', $email)->exists()) {
            $this->command?->info("Admin user {$email} already exists; skipping.");
            return;
        }

        User::create([
            'name' => env('ADMIN_NAME', 'IT Assistance BD Admin'),
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'admin',
        ]);

        $this->command?->info("Admin user created: {$email}");
    }
}