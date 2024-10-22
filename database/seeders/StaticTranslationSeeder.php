<?php

namespace Database\Seeders;

use App\Models\Admin\StaticTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StaticTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StaticTranslation::create([
            'key' => 'view_all_btn',
            'lang_code' => 'en',
            'value' => 'View All',
            'page' => 'home',
        ]);
    }
}
