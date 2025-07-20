<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'User Satu',
            'email' => 'user1@example.com',
            'password' => Hash::make('user12345'),
        ]);

        User::create([
            'name' => 'User Dua',
            'email' => 'user2@example.com',
            'password' => Hash::make('user67890'),
        ]);
    }
}
