<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'gender' => 'Male',
            'country' => 'Bangladesh',
        ]);
        User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('12345678'),
            'gender' => 'Female',
            'country' => 'Bangladesh',
        ]);
        User::create([
            'name' => 'Writer',
            'email' => 'writer@gmail.com',
            'password' => Hash::make('12345678'),
            'gender' => 'Others',
            'country' => 'Bangladesh',
        ]);
    }
}
