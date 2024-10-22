<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'      => 'admin',
            'email'     => 'admin@gmail.com',
            'password'  => Hash::make('12345678'),
            'role'      => 1,
            'phone'     => '0123456789',
            'address'   => 'Dhaka, Bangladesh',
            'image'     => null
        ]);

        User::create([
            'name'      => 'super admin',
            'email'     => 'superadmin@gmail.com',
            'password'  => Hash::make('12345678'),
            'role'      => 1,
            'phone'     => '0133456789',
            'address'   => 'Dhaka, Bangladesh',
            'image'     => null
        ]);
    }
}
