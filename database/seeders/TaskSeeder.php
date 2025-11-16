<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Lead;
use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $clients = Client::all();
        $leads = Lead::all();
        
        $tasks = [
            [
                'title' => 'Follow up on proposal',
                'description' => 'Call client to discuss proposal details and answer questions',
                'status' => 'pending',
                'priority' => 'high',
                'due_date' => now()->addDays(2),
                'client_id' => $clients->random()->id,
            ],
            [
                'title' => 'Send contract for review',
                'description' => 'Prepare and send contract documents to client legal team',
                'status' => 'in_progress',
                'priority' => 'high',
                'due_date' => now()->addDays(1),
                'client_id' => $clients->random()->id,
            ],
            [
                'title' => 'Prepare project presentation',
                'description' => 'Create slides for upcoming project kickoff meeting',
                'status' => 'pending',
                'priority' => 'medium',
                'due_date' => now()->addDays(5),
                'client_id' => $clients->random()->id,
            ],
            [
                'title' => 'Review design mockups',
                'description' => 'Review and provide feedback on initial design concepts',
                'status' => 'pending',
                'priority' => 'medium',
                'due_date' => now()->addDays(3),
                'client_id' => $clients->random()->id,
            ],
            [
                'title' => 'Schedule follow-up call',
                'description' => 'Reach out to lead to schedule discovery call',
                'status' => 'pending',
                'priority' => 'high',
                'due_date' => now()->addDays(1),
                'lead_id' => $leads->where('status', 'new')->first()?->id,
            ],
            [
                'title' => 'Send project update email',
                'description' => 'Weekly status update to client stakeholders',
                'status' => 'completed',
                'priority' => 'low',
                'due_date' => now()->subDays(1),
                'client_id' => $clients->random()->id,
            ],
            [
                'title' => 'Prepare invoice',
                'description' => 'Generate and send invoice for completed milestone',
                'status' => 'pending',
                'priority' => 'medium',
                'due_date' => now()->addDays(2),
                'client_id' => $clients->random()->id,
            ],
            [
                'title' => 'Research competitor analysis',
                'description' => 'Gather information on competitor offerings for proposal',
                'status' => 'in_progress',
                'priority' => 'medium',
                'due_date' => now()->addDays(4),
                'lead_id' => $leads->where('status', 'proposal')->first()?->id,
            ],
            [
                'title' => 'Update project documentation',
                'description' => 'Document recent changes and decisions made in meeting',
                'status' => 'pending',
                'priority' => 'low',
                'due_date' => now()->addDays(7),
                'client_id' => $clients->random()->id,
            ],
            [
                'title' => 'Prepare quarterly report',
                'description' => 'Compile metrics and achievements for client review',
                'status' => 'pending',
                'priority' => 'high',
                'due_date' => now()->addDays(3),
                'client_id' => $clients->random()->id,
            ],
        ];

        foreach ($tasks as $taskData) {
            Task::create($taskData);
        }
    }
}

