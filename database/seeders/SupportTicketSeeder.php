<?php

namespace Database\Seeders;

use App\Models\Frontend\SupportContent;
use App\Models\Frontend\SupportTicket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupportTicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $support = SupportTicket::create([
            'token' => 'ST'.str_pad(01, 8, '0', STR_PAD_LEFT),
            'subject' => 'Begin a Support Ticket',
            'email' => 'test@test.com',
            'status' => '1',
        ]);
        SupportContent::create([
            'support_ticket_id' => $support->id,
            'message' => 'This is a test message.',
            'sent_by' => 0,
        ]);
    }
}
