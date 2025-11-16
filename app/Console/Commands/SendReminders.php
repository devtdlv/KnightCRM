<?php

namespace App\Console\Commands;

use App\Mail\ReminderMail;
use App\Models\Reminder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendReminders extends Command
{
    protected $signature = 'reminders:send';

    protected $description = 'Send scheduled email reminders';

    public function handle()
    {
        $now = now();
        
        // Get reminders that should be sent (due now or in the past, but not yet sent)
        $reminders = Reminder::where('sent', false)
            ->where('remind_at', '<=', $now)
            ->get();

        if ($reminders->isEmpty()) {
            $this->info('No reminders to send.');
            return 0;
        }

        $sentCount = 0;

        foreach ($reminders as $reminder) {
            try {
                Mail::to($reminder->email_to)->send(new ReminderMail($reminder));
                
                $reminder->update(['sent' => true]);
                $sentCount++;
                
                $this->info("Sent reminder: {$reminder->title} to {$reminder->email_to}");
            } catch (\Exception $e) {
                $this->error("Failed to send reminder {$reminder->id}: {$e->getMessage()}");
            }
        }

        $this->info("Sent {$sentCount} reminder(s).");
        return 0;
    }
}

