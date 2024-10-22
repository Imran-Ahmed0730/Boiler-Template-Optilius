<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            "Country Add", "Country Delete", "Country Update", "Country View",
            "Email Template Add", "Email Template Delete", "Email Template Title Edit", "Email Template Update", "Email Template View",
            "Frontend-Page Add", "Frontend-Page Delete", "Frontend-Page Update", "Frontend-Page View",
            "Live Chat", "Live Chat Assignment", "Live Chat List View", "Live Chat View",
            "Message Delete", "Message View",
            "Page Create", "Page Delete", "Page Update", "Page View",
            "Permission Add", "Permission Delete", "Permission Update", "Permission View",
            "Role Add", "Role Assignment", "Role Delete", "Role Permission Add/Update", "Role Update", "Role View",
            "Settings Add", "Settings Contact", "Settings Language", "Settings Logo & Favicon", "Settings Site", "Settings Social Media", "Settings Store", "Settings Update", "Settings User", "Settings View",
            "Sms Template Add", "Sms Template Delete", "Sms Template Title Edit", "Sms Template Update", "Sms Template View",
            "Staff Create", "Staff Delete", "Staff Update", "Staff View",
            "Static Translation Delete", "Static Translation Key Add", "Static Translation Page View", "Static Translation Update", "Static Translation View",
            "Subscriber View",
            "Support Chat", "Support Chat Assignment", "Support Chat View", "Support Close", "Support Open", "Support View",
            ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
