<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Regular user – sudah terverifikasi email
        User::firstOrCreate(
            ['email' => 'user@ruangtenang.test'],
            [
                'name'              => 'Test User',
                'password'          => Hash::make('password'),
                'role'              => 'user',
                'email_verified_at' => now(),
            ]
        );

        // 2. Admin user – sudah terverifikasi email
        User::firstOrCreate(
            ['email' => 'admin@ruangtenang.test'],
            [
                'name'              => 'Admin Ruang Tenang',
                'password'          => Hash::make('password'),
                'role'              => 'admin',
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('UserSeeder: user@ruangtenang.test & admin@ruangtenang.test siap digunakan.');
    }
}
