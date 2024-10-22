<?php

namespace Database\Seeders;

use App\Models\Admin\EmailTemplate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmailTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EmailTemplate::create([
            'title' => 'Sign Up ',
            'body' => '<p>Thank you for sign up. We hope you\'ll have a good time with us</p>',
        ]);
    }
}
