<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // System User
        User::create([
            'name' => 'System User',
            'slug' => Str::slug('System User'),
            'email' => 'system@example.com',
            'phone' => '1234567890',
            'role' => 'system',
            'gender' => 'male',
            'password' => Hash::make('root'),
            'status' => true,
        ]);

        // Owner User
        User::create([
            'name' => 'Owner User',
            'slug' => Str::slug('Owner User'),
            'email' => 'owner@example.com',
            'phone' => '0987654321',
            'role' => 'owner',
            'gender' => 'female',
            'password' => Hash::make('root'),
            'status' => true,
        ]);

        // Seller User
        User::create([
            'name' => 'Seller User',
            'slug' => Str::slug('Seller User'),
            'email' => 'seller@example.com',
            'phone' => '1122334455',
            'role' => 'seller',
            'gender' => 'male',
            'password' => Hash::make('root'),
            'status' => true,
        ]);
    }
}
