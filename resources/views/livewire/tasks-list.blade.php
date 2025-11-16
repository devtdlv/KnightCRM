<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-3xl font-bold text-gray-900">Tasks</h2>
        <button wire:click="openModal" class="bg-knight-600 hover:bg-knight-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
            + New Task
        </button>
    </div>

    <!-- Filters -->
    <div class="flex gap-2 flex-wrap">
        <select wire:model.live="filterStatus" class="px-3 py-2 rounded-lg border-2 border-gray-300 shadow-sm focus:border-knight-500 focus:ring-knight-500">
            <option value="">All Statuses</option>
            <option value="pending">Pending</option>
            <option value="in_progress">In Progress</option>
            <option value="completed">Completed</option>
        </select>
        <select wire:model.live="filterPriority" class="px-3 py-2 rounded-lg border-2 border-gray-300 shadow-sm focus:border-knight-500 focus:ring-knight-500">
            <option value="">All Priorities</option>
            <option value="low">Low</option>
            <option value="medium">Medium</option>
            <option value="high">High</option>
        </select>
    </div>

    <!-- Tasks List -->
    <div class="space-y-4">
        @forelse($tasks as $task)
            <div class="bg-white rounded-lg shadow p-6 {{ $task->isOverdue() ? 'border-l-4 border-red-500' : '' }}">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <input type="checkbox" wire:click="toggleStatus({{ $task->id }})" {{ $task->status === 'completed' ? 'checked' : '' }} class="rounded border-2 border-gray-300 text-knight-600 focus:ring-knight-500">
                            <h3 class="text-lg font-semibold text-gray-900 {{ $task->status === 'completed' ? 'line-through text-gray-500' : '' }}">{{ $task->title }}</h3>
                        </div>
                        @if($task->description)
                            <p class="text-sm text-gray-600 mb-2">{{ $task->description }}</p>
                        @endif
                        <div class="flex gap-4 text-sm text-gray-500">
                            @if($task->due_date)
                                <span class="{{ $task->isOverdue() ? 'text-red-600 font-semibold' : '' }}">
                                    📅 {{ $task->due_date->format('M d, Y') }}
                                </span>
                            @endif
                            @if($task->client)
                                <span>👤 {{ $task->client->name }}</span>
                            @endif
                            @if($task->lead)
                                <span>🎯 {{ $task->lead->name }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $task->priority_color }}">
                            {{ ucfirst($task->priority) }}
                        </span>
                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $task->status_color }}">
                            {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                        </span>
                        <button wire:click="openModal({{ $task->id }})" class="text-knight-600 hover:text-knight-900 text-sm">Edit</button>
                        <button wire:click="delete({{ $task->id }})" wire:confirm="Are you sure?" class="text-red-600 hover:text-red-900 text-sm">Delete</button>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-lg shadow p-6 text-center text-gray-500">
                No tasks found.
            </div>
        @endforelse
    </div>

    {{ $tasks->links('livewire::tailwind') }}

    <!-- Modal -->
    @if($showModal)
    <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" wire:click="closeModal"></div>

            <!-- Center modal -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!-- Modal panel -->
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" wire:click.stop>
                <!-- Header -->
                <div class="bg-knight-600 px-6 py-4 flex justify-between items-center">
                    <h3 class="text-xl font-semibold text-white">{{ $editingTask ? 'Edit Task' : 'New Task' }}</h3>
                    <button wire:click="closeModal" class="text-white hover:text-gray-200 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Content -->
                <form wire:submit.prevent="save">
                    <div class="bg-white px-6 py-4 max-h-[70vh] overflow-y-auto">
                        <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Title *</label>
                            <input type="text" wire:model="title" class="mt-1 block w-full px-3 py-2 rounded-md border-2 border-gray-300 shadow-sm focus:border-knight-500 focus:ring-knight-500">
                            @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea wire:model="description" rows="3" class="mt-1 block w-full px-3 py-2 rounded-md border-2 border-gray-300 shadow-sm focus:border-knight-500 focus:ring-knight-500"></textarea>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Status *</label>
                                <select wire:model="status" class="mt-1 block w-full px-3 py-2 rounded-md border-2 border-gray-300 shadow-sm focus:border-knight-500 focus:ring-knight-500">
                                    <option value="pending">Pending</option>
                                    <option value="in_progress">In Progress</option>
                                    <option value="completed">Completed</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Priority *</label>
                                <select wire:model="priority" class="mt-1 block w-full px-3 py-2 rounded-md border-2 border-gray-300 shadow-sm focus:border-knight-500 focus:ring-knight-500">
                                    <option value="low">Low</option>
                                    <option value="medium">Medium</option>
                                    <option value="high">High</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Due Date</label>
                            <input type="date" wire:model="due_date" class="mt-1 block w-full px-3 py-2 rounded-md border-2 border-gray-300 shadow-sm focus:border-knight-500 focus:ring-knight-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Client</label>
                            <select wire:model="client_id" class="mt-1 block w-full px-3 py-2 rounded-md border-2 border-gray-300 shadow-sm focus:border-knight-500 focus:ring-knight-500">
                                <option value="">None</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Lead</label>
                            <select wire:model="lead_id" class="mt-1 block w-full px-3 py-2 rounded-md border-2 border-gray-300 shadow-sm focus:border-knight-500 focus:ring-knight-500">
                                <option value="">None</option>
                                @foreach($leads as $lead)
                                    <option value="{{ $lead->id }}">{{ $lead->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="bg-gray-50 px-6 py-4 flex justify-end gap-3 border-t">
                        <button type="button" wire:click="closeModal" class="px-4 py-2 bg-white border-2 border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-knight-500">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-knight-600 text-white rounded-lg hover:bg-knight-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-knight-500">
                            {{ $editingTask ? 'Update Task' : 'Create Task' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>

