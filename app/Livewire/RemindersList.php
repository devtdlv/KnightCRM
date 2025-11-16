<?php

namespace App\Livewire;

use App\Models\Client;
use App\Models\Lead;
use App\Models\Reminder;
use Livewire\Component;
use Livewire\WithPagination;

class RemindersList extends Component
{
    use WithPagination;

    public $showModal = false;
    public $editingReminder = null;
    public $title = '';
    public $message = '';
    public $remind_at = '';
    public $email_to = '';
    public $client_id = null;
    public $lead_id = null;

    protected $rules = [
        'title' => 'required|string|max:255',
        'message' => 'required|string',
        'remind_at' => 'required|date|after:now',
        'email_to' => 'required|email|max:255',
        'client_id' => 'nullable|exists:clients,id',
        'lead_id' => 'nullable|exists:leads,id',
    ];

    public function openModal($reminderId = null)
    {
        $this->editingReminder = $reminderId;
        if ($reminderId) {
            $reminder = Reminder::findOrFail($reminderId);
            $this->title = $reminder->title;
            $this->message = $reminder->message;
            $this->remind_at = $reminder->remind_at->format('Y-m-d\TH:i');
            $this->email_to = $reminder->email_to;
            $this->client_id = $reminder->client_id;
            $this->lead_id = $reminder->lead_id;
        } else {
            $this->resetForm();
        }
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
        $this->editingReminder = null;
    }

    public function resetForm()
    {
        $this->title = '';
        $this->message = '';
        $this->remind_at = '';
        $this->email_to = '';
        $this->client_id = null;
        $this->lead_id = null;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'message' => $this->message,
            'remind_at' => $this->remind_at,
            'email_to' => $this->email_to,
            'client_id' => $this->client_id,
            'lead_id' => $this->lead_id,
        ];

        if ($this->editingReminder) {
            Reminder::findOrFail($this->editingReminder)->update($data);
            session()->flash('message', 'Reminder updated successfully!');
        } else {
            Reminder::create($data);
            session()->flash('message', 'Reminder created successfully!');
        }

        $this->closeModal();
    }

    public function delete($reminderId)
    {
        Reminder::findOrFail($reminderId)->delete();
        session()->flash('message', 'Reminder deleted successfully!');
    }

    public function render()
    {
        $reminders = Reminder::with(['client', 'lead'])
            ->where('sent', false)
            ->orderBy('remind_at', 'asc')
            ->paginate(10);
        
        $clients = Client::orderBy('name')->get();
        $leads = Lead::orderBy('name')->get();

        return view('livewire.reminders-list', [
            'reminders' => $reminders,
            'clients' => $clients,
            'leads' => $leads,
        ]);
    }
}

