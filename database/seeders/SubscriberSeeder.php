<?php

namespace Database\Seeders;

use App\Models\Admin\Subscriber;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subscriber::create([
            'email' => 'subscriber@gmail.com',
        ]);
    }
}
