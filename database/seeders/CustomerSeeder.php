<?php

namespace Database\Seeders;

use App\Models\Frontend\Customer;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Customer 1',
            'email' => 'customer1@gmail.com',
            'password' => Hash::make('12345678'),
            'phone' => '0133456789',
        ]);
        Customer::create([
            'user_id' => $user->id,
            'name' => 'Customer 1',
            'email' => 'customer1@gmail.com',
            'password' => Hash::make('12345678'),
            'phone' => '0133456789',
            'status' => '1',
        ]);
    }
}
