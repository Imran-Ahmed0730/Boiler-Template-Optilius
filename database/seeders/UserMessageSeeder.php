<?php

namespace Database\Seeders;

use App\Models\Frontend\UserMessage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserMessage::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'subject' => 'This is subject',
            'message' => 'This is message',
        ]);
    }
}
