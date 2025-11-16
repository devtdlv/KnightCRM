<?php

namespace App\Livewire;

use App\Models\Client;
use Livewire\Component;
use Livewire\WithPagination;

class ClientsList extends Component
{
    use WithPagination;

    public $showModal = false;
    public $editingClient = null;
    public $name = '';
    public $email = '';
    public $phone = '';
    public $company = '';
    public $address = '';
    public $search = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'nullable|email|max:255',
        'phone' => 'nullable|string|max:255',
        'company' => 'nullable|string|max:255',
        'address' => 'nullable|string',
    ];

    public function openModal($clientId = null)
    {
        $this->editingClient = $clientId;
        if ($clientId) {
            $client = Client::findOrFail($clientId);
            $this->name = $client->name;
            $this->email = $client->email;
            $this->phone = $client->phone;
            $this->company = $client->company;
            $this->address = $client->address;
        } else {
            $this->resetForm();
        }
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
        $this->editingClient = null;
    }

    public function resetForm()
    {
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->company = '';
        $this->address = '';
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'company' => $this->company,
            'address' => $this->address,
        ];

        if ($this->editingClient) {
            Client::findOrFail($this->editingClient)->update($data);
            session()->flash('message', 'Client updated successfully!');
        } else {
            Client::create($data);
            session()->flash('message', 'Client created successfully!');
        }

        $this->closeModal();
    }

    public function delete($clientId)
    {
        Client::findOrFail($clientId)->delete();
        session()->flash('message', 'Client deleted successfully!');
    }

    public function render()
    {
        $query = Client::query();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%')
                  ->orWhere('company', 'like', '%' . $this->search . '%');
            });
        }

        $clients = $query->withCount(['notes', 'tasks', 'leads'])->latest()->paginate(10);

        return view('livewire.clients-list', [
            'clients' => $clients,
        ]);
    }
}

