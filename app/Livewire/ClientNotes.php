<?php

namespace App\Livewire;

use App\Models\Client;
use App\Models\Note;
use Livewire\Component;

class ClientNotes extends Component
{
    public $clientId;
    public $client;
    public $content = '';
    public $editingNoteId = null;

    public function mount($clientId)
    {
        $this->clientId = $clientId;
        $this->client = Client::with('notes')->findOrFail($clientId);
    }

    public function saveNote()
    {
        $this->validate([
            'content' => 'required|string|min:3',
        ]);

        if ($this->editingNoteId) {
            Note::findOrFail($this->editingNoteId)->update([
                'content' => $this->content,
            ]);
            session()->flash('message', 'Note updated successfully!');
        } else {
            Note::create([
                'content' => $this->content,
                'client_id' => $this->clientId,
            ]);
            session()->flash('message', 'Note added successfully!');
        }

        $this->content = '';
        $this->editingNoteId = null;
        $this->client->refresh();
    }

    public function editNote($noteId)
    {
        $note = Note::findOrFail($noteId);
        $this->content = $note->content;
        $this->editingNoteId = $noteId;
    }

    public function cancelEdit()
    {
        $this->content = '';
        $this->editingNoteId = null;
    }

    public function deleteNote($noteId)
    {
        Note::findOrFail($noteId)->delete();
        session()->flash('message', 'Note deleted successfully!');
        $this->client->refresh();
    }

    public function render()
    {
        return view('livewire.client-notes');
    }
}

