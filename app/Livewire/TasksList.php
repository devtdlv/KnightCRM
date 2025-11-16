<?php

namespace App\Livewire;

use App\Models\Client;
use App\Models\Lead;
use App\Models\Task;
use Livewire\Component;
use Livewire\WithPagination;

class TasksList extends Component
{
    use WithPagination;

    public $showModal = false;
    public $editingTask = null;
    public $title = '';
    public $description = '';
    public $status = 'pending';
    public $priority = 'medium';
    public $due_date = '';
    public $client_id = null;
    public $lead_id = null;
    public $filterStatus = '';
    public $filterPriority = '';

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'status' => 'required|in:pending,in_progress,completed',
        'priority' => 'required|in:low,medium,high',
        'due_date' => 'nullable|date',
        'client_id' => 'nullable|exists:clients,id',
        'lead_id' => 'nullable|exists:leads,id',
    ];

    public function openModal($taskId = null)
    {
        $this->editingTask = $taskId;
        if ($taskId) {
            $task = Task::findOrFail($taskId);
            $this->title = $task->title;
            $this->description = $task->description;
            $this->status = $task->status;
            $this->priority = $task->priority;
            $this->due_date = $task->due_date?->format('Y-m-d');
            $this->client_id = $task->client_id;
            $this->lead_id = $task->lead_id;
        } else {
            $this->resetForm();
        }
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
        $this->editingTask = null;
    }

    public function resetForm()
    {
        $this->title = '';
        $this->description = '';
        $this->status = 'pending';
        $this->priority = 'medium';
        $this->due_date = '';
        $this->client_id = null;
        $this->lead_id = null;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'priority' => $this->priority,
            'due_date' => $this->due_date ?: null,
            'client_id' => $this->client_id,
            'lead_id' => $this->lead_id,
        ];

        if ($this->editingTask) {
            Task::findOrFail($this->editingTask)->update($data);
            session()->flash('message', 'Task updated successfully!');
        } else {
            Task::create($data);
            session()->flash('message', 'Task created successfully!');
        }

        $this->closeModal();
    }

    public function delete($taskId)
    {
        Task::findOrFail($taskId)->delete();
        session()->flash('message', 'Task deleted successfully!');
    }

    public function toggleStatus($taskId)
    {
        $task = Task::findOrFail($taskId);
        $task->update([
            'status' => $task->status === 'completed' ? 'pending' : 'completed',
        ]);
        session()->flash('message', 'Task status updated!');
    }

    public function render()
    {
        $query = Task::with(['client', 'lead']);

        if ($this->filterStatus) {
            $query->where('status', $this->filterStatus);
        }

        if ($this->filterPriority) {
            $query->where('priority', $this->filterPriority);
        }

        $tasks = $query->orderBy('due_date', 'asc')->latest()->paginate(10);
        $clients = Client::orderBy('name')->get();
        $leads = Lead::orderBy('name')->get();

        return view('livewire.tasks-list', [
            'tasks' => $tasks,
            'clients' => $clients,
            'leads' => $leads,
        ]);
    }
}

