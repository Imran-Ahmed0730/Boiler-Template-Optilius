<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'Super Admin']);
        $user = User::where('email', 'admin@admin.com')->first();
        $user->assignRole(1);
        $user = User::where('email', 'superadmin@admin.com')->first();
        $user->assignRole(2);
    }
}
