<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Default admin for MKPDesign staff login (change password in production).
     */
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@mkpdesign.com'],
            [
                'name' => 'MKPDesign Admin',
                'password' => Hash::make('MKPDesign@2026'),
                'email_verified_at' => now(),
            ]
        );
    }
}
