<?php

namespace Database\Seeders;

use App\Models\Admin\SmsTemplate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SmsTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SmsTemplate::create([
            'title' => 'Sign Up Message',
            'body' => 'Thank you for sign up. We hope you\'ll have a good time with us',
        ]);
    }
}
