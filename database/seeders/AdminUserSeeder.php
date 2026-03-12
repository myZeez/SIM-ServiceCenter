<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Super Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@cellcom.com',
            'password' => Hash::make('password'),
            'role' => 'super_admin',
            'phone' => '081234567890',
            'is_active' => true,
        ]);

        // Create Admin
        User::create([
            'name' => 'Admin Cellcom',
            'email' => 'admin2@cellcom.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '081234567891',
            'is_active' => true,
        ]);

        // Create Teknisi
        User::create([
            'name' => 'Teknisi 1',
            'email' => 'teknisi@cellcom.com',
            'password' => Hash::make('password'),
            'role' => 'teknisi',
            'phone' => '081234567892',
            'is_active' => true,
        ]);

        $this->command->info('Users created successfully!');
        $this->command->info('Super Admin: admin@cellcom.com / password');
        $this->command->info('Admin: admin2@cellcom.com / password');
        $this->command->info('Teknisi: teknisi@cellcom.com / password');
    }
}
