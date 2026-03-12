<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@cellcom.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'role' => 'super_admin',
                'phone' => '081234567890',
                'is_active' => true,
            ]
        );

        User::updateOrCreate(
            ['email' => 'admin2@cellcom.com'],
            [
                'name' => 'Admin Cellcom',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'phone' => '081234567891',
                'is_active' => true,
            ]
        );

        User::updateOrCreate(
            ['email' => 'teknisi@cellcom.com'],
            [
                'name' => 'Teknisi 1',
                'password' => Hash::make('password'),
                'role' => 'teknisi',
                'phone' => '081234567892',
                'is_active' => true,
            ]
        );

        $this->command->info('Users created successfully!');
        $this->command->info('Super Admin: admin@cellcom.com / password');
        $this->command->info('Admin: admin2@cellcom.com / password');
        $this->command->info('Teknisi: teknisi@cellcom.com / password');
    }
}
