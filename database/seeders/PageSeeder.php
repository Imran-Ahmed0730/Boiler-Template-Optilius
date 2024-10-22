<?php

namespace Database\Seeders;

use App\Models\Admin\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'title' => 'About Us',
                'slug' => 'about-us',
                'content' => '<p>This is about us page</p>'
            ],
            [
                'title' => 'Terms & Conditions',
                'slug' => 'terms-and-conditions',
                'content' => '<p>This is terms and condition page</p>'
            ],
            [
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'content' => '<p>This is privacy policy page</p>'
            ],
            [
                'title' => 'FAQ',
                'slug' => 'faq',
                'content' => '<p>This is faq page</p>'
            ],
            [
                'title' => 'Help',
                'slug' => 'help',
                'content' => '<p>This is help page</p>'
            ],
        ];

        foreach ($pages as $page) {
            Page::create($page);
        }

    }
}
