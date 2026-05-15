<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Default MKPDesign admin (rotate password in production).
     *
     * Email: admin@mkpdesign.com
     * Password: MKPDesign@2026
     */
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@mkpdesign.com'],
            [
                'name' => 'MKPDesign Admin',
                'password' => 'test1234',
                'email_verified_at' => now(),
            ]
        );
    }
}
