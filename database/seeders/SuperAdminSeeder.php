<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'superadmin@kosinaja.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('orbitgacor'),
                'role' => 'super_admin',
                'status' => 'approved',
            ]
        );
    }
}