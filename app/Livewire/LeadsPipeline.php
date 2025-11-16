<?php

namespace App\Livewire;

use App\Models\Lead;
use Livewire\Component;
use Livewire\WithPagination;

class LeadsPipeline extends Component
{
    use WithPagination;

    public $showModal = false;
    public $editingLead = null;
    public $name = '';
    public $email = '';
    public $phone = '';
    public $company = '';
    public $status = 'new';
    public $value = '';
    public $source = '';
    public $notes = '';
    public $client_id = null;
    public $filterStatus = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'nullable|email|max:255',
        'phone' => 'nullable|string|max:255',
        'company' => 'nullable|string|max:255',
        'status' => 'required|in:new,contacted,qualified,proposal,negotiation,won,lost',
        'value' => 'nullable|numeric|min:0',
        'source' => 'nullable|string',
        'notes' => 'nullable|string',
    ];

    public function openModal($leadId = null)
    {
        $this->editingLead = $leadId;
        if ($leadId) {
            $lead = Lead::findOrFail($leadId);
            $this->name = $lead->name;
            $this->email = $lead->email;
            $this->phone = $lead->phone;
            $this->company = $lead->company;
            $this->status = $lead->status;
            $this->value = $lead->value;
            $this->source = $lead->source;
            $this->notes = $lead->notes;
            $this->client_id = $lead->client_id;
        } else {
            $this->resetForm();
        }
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
        $this->editingLead = null;
    }

    public function resetForm()
    {
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->company = '';
        $this->status = 'new';
        $this->value = '';
        $this->source = '';
        $this->notes = '';
        $this->client_id = null;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'company' => $this->company,
            'status' => $this->status,
            'value' => $this->value ?: null,
            'source' => $this->source,
            'notes' => $this->notes,
            'client_id' => $this->client_id,
        ];

        if ($this->editingLead) {
            Lead::findOrFail($this->editingLead)->update($data);
            session()->flash('message', 'Lead updated successfully!');
        } else {
            Lead::create($data);
            session()->flash('message', 'Lead created successfully!');
        }

        $this->closeModal();
    }

    public function delete($leadId)
    {
        Lead::findOrFail($leadId)->delete();
        session()->flash('message', 'Lead deleted successfully!');
    }

    public function updateStatus($leadId, $status)
    {
        Lead::findOrFail($leadId)->update(['status' => $status]);
        session()->flash('message', 'Lead status updated!');
    }

    public function render()
    {
        $query = Lead::query();

        if ($this->filterStatus) {
            $query->where('status', $this->filterStatus);
        }

        $leads = $query->with('client')->latest()->paginate(10);

        $statusCounts = Lead::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        return view('livewire.leads-pipeline', [
            'leads' => $leads,
            'statusCounts' => $statusCounts,
        ]);
    }
}

