<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Lead;
use App\Models\Reminder;
use Illuminate\Database\Seeder;

class ReminderSeeder extends Seeder
{
    public function run(): void
    {
        $clients = Client::all();
        $leads = Lead::all();
        
        $reminders = [
            [
                'title' => 'Follow up on proposal',
                'message' => 'Don\'t forget to follow up with the client about the proposal we sent last week. They mentioned they would review it by today.',
                'remind_at' => now()->addHours(2),
                'email_to' => 'you@example.com',
                'client_id' => $clients->random()->id,
            ],
            [
                'title' => 'Project milestone deadline',
                'message' => 'The first project milestone is due tomorrow. Make sure all deliverables are ready and send status update to client.',
                'remind_at' => now()->addDays(1),
                'email_to' => 'you@example.com',
                'client_id' => $clients->random()->id,
            ],
            [
                'title' => 'Lead follow-up call',
                'message' => 'Schedule a follow-up call with the lead to discuss their requirements and answer any questions about our services.',
                'remind_at' => now()->addDays(2),
                'email_to' => 'you@example.com',
                'lead_id' => $leads->where('status', 'contacted')->first()?->id,
            ],
            [
                'title' => 'Contract renewal discussion',
                'message' => 'Time to discuss contract renewal with the client. Prepare proposal for next year\'s services.',
                'remind_at' => now()->addDays(5),
                'email_to' => 'you@example.com',
                'client_id' => $clients->random()->id,
            ],
            [
                'title' => 'Send project update',
                'message' => 'Weekly project update email is due. Include progress, upcoming tasks, and any blockers.',
                'remind_at' => now()->addDays(7),
                'email_to' => 'you@example.com',
                'client_id' => $clients->random()->id,
            ],
        ];

        foreach ($reminders as $reminderData) {
            Reminder::create($reminderData);
        }
    }
}

