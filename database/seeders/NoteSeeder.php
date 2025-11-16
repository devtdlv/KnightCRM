<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Note;
use Illuminate\Database\Seeder;

class NoteSeeder extends Seeder
{
    public function run(): void
    {
        $clients = Client::all();
        
        $notes = [
            'Had initial discovery call. Client is interested in a complete website redesign. Budget approved for Q2.',
            'Followed up on proposal. Client requested additional features in the scope. Need to revise pricing.',
            'Great meeting today! Discussed the project timeline. They want to launch by end of month.',
            'Client mentioned they are also considering another agency. Need to emphasize our unique value proposition.',
            'Sent contract for review. Waiting for legal team approval. Expected response by Friday.',
            'Project kickoff meeting scheduled for next week. All stakeholders confirmed attendance.',
            'Client provided feedback on initial designs. Mostly positive, minor revisions requested.',
            'Discussed ongoing maintenance package. Client is interested in monthly retainer option.',
            'Celebrated project completion! Client is very happy with the results. Potential for future projects.',
            'Annual review meeting. Discussed next year\'s strategy and potential expansion of services.',
        ];

        foreach ($clients as $index => $client) {
            // Add 2-3 notes per client
            $numNotes = rand(2, 3);
            for ($i = 0; $i < $numNotes; $i++) {
                $noteIndex = ($index * 2 + $i) % count($notes);
                Note::create([
                    'client_id' => $client->id,
                    'content' => $notes[$noteIndex],
                    'created_at' => now()->subDays(rand(1, 30)),
                ]);
            }
        }
    }
}

