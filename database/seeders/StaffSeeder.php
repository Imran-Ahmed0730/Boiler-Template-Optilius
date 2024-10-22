<?php

namespace Database\Seeders;

use App\Models\Admin\Staff;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name'=> 'Staff1',
            'email' => 'staff1@gmail.com',
            'phone' => '01234567890',
            'address' => 'Dhaka Bangladesh',
            'password' => Hash::make(12345678),
            'role' => 4,
        ]);

        Staff::create([
            'user_id' => $user->id,
            'name'=> $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'address' => $user->address,
            'password' => Hash::make(12345678),
            'salary' => 5000,
            'nid_no' => '1234567890',
            'join_date' => date('Y-m-d'),
            'status' => 1,
        ]);
    }
}
