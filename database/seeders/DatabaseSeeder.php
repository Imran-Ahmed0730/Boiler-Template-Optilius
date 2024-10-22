<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(PageSeeder::class);
        $this->call(SubscriberSeeder::class);
        $this->call(SmsTemplateSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(StaffSeeder::class);
        $this->call(SupportTicketSeeder::class);
        $this->call(UserMessageSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(EmailTemplateSeeder::class);
        $this->call(StaticTranslationSeeder::class);
        $this->call(FrontendPageSeeder::class);
    }
}
