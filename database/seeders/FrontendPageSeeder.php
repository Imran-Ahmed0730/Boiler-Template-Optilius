<?php

namespace Database\Seeders;

use App\Http\Controllers\Admin\FrontendPageController;
use App\Models\Admin\FrontendPage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FrontendPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = ['home', 'about', 'faq', 'contact'];
        foreach ($pages as $page) {
            FrontendPage::create([
                'title'=> $page,
                'status' => 1
            ]);
        }
    }
}
