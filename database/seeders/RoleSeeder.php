<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin_role = Role::create(['name' => 'admin']);
        $super_admin_role = Role::create(['name' => 'Super Admin']);
        $permissions = Permission::latest()->pluck('name')->toArray();
        $super_admin_role->syncPermissions($permissions);

        $user = User::where('email', 'admin@gmail.com')->first();
        $user->assignRole(1);
        $user = User::where('email', 'superadmin@gmail.com')->first();
        $user->assignRole(2);
    }
}
