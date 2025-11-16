<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-3xl font-bold text-gray-900">Email Reminders</h2>
        <button wire:click="openModal" class="bg-knight-600 hover:bg-knight-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
            + New Reminder
        </button>
    </div>

    <!-- Reminders List -->
    <div class="space-y-4">
        @forelse($reminders as $reminder)
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $reminder->title }}</h3>
                        <p class="text-sm text-gray-600 mt-1">{{ $reminder->message }}</p>
                        <div class="flex gap-4 mt-3 text-sm text-gray-500">
                            <span>📧 {{ $reminder->email_to }}</span>
                            <span>⏰ {{ $reminder->remind_at->format('M d, Y h:i A') }}</span>
                            @if($reminder->client)
                                <span>👤 {{ $reminder->client->name }}</span>
                            @endif
                            @if($reminder->lead)
                                <span>🎯 {{ $reminder->lead->name }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button wire:click="openModal({{ $reminder->id }})" class="text-knight-600 hover:text-knight-900 text-sm">Edit</button>
                        <button wire:click="delete({{ $reminder->id }})" wire:confirm="Are you sure?" class="text-red-600 hover:text-red-900 text-sm">Delete</button>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-lg shadow p-6 text-center text-gray-500">
                No reminders found.
            </div>
        @endforelse
    </div>

    {{ $reminders->links('livewire::tailwind') }}

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
                    <h3 class="text-xl font-semibold text-white">{{ $editingReminder ? 'Edit Reminder' : 'New Reminder' }}</h3>
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
                            <label class="block text-sm font-medium text-gray-700">Message *</label>
                            <textarea wire:model="message" rows="4" class="mt-1 block w-full px-3 py-2 rounded-md border-2 border-gray-300 shadow-sm focus:border-knight-500 focus:ring-knight-500"></textarea>
                            @error('message') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email To *</label>
                            <input type="email" wire:model="email_to" class="mt-1 block w-full px-3 py-2 rounded-md border-2 border-gray-300 shadow-sm focus:border-knight-500 focus:ring-knight-500">
                            @error('email_to') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Remind At *</label>
                            <input type="datetime-local" wire:model="remind_at" class="mt-1 block w-full px-3 py-2 rounded-md border-2 border-gray-300 shadow-sm focus:border-knight-500 focus:ring-knight-500">
                            @error('remind_at') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
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
                            {{ $editingReminder ? 'Update Reminder' : 'Create Reminder' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>

