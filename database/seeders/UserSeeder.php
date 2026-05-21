<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Salma Admin',
            'email' => 'admin@beautyhouse.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Jane Customer',
            'email' => 'customer@beautyhouse.com',
            'password' => Hash::make('customer123'),
            'role' => 'customer',
        ]);
    }
}
