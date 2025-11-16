<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-3xl font-bold text-gray-900">Clients</h2>
        <div class="flex gap-2">
            <a href="{{ route('clients.export') }}" class="bg-knight-600 hover:bg-knight-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                Export CSV
            </a>
            <button wire:click="openModal" class="bg-knight-600 hover:bg-knight-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                + New Client
            </button>
        </div>
    </div>

    <!-- Search -->
    <div>
        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search clients..." class="w-full max-w-md px-3 py-2 rounded-lg border-2 border-gray-300 shadow-sm focus:border-knight-500 focus:ring-knight-500">
    </div>

    <!-- Clients Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($clients as $client)
            <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">{{ $client->name }}</h3>
                        @if($client->company)
                            <p class="text-sm text-gray-500">{{ $client->company }}</p>
                        @endif
                    </div>
                    <div class="flex gap-2">
                        <button wire:click="openModal({{ $client->id }})" class="text-knight-600 hover:text-knight-900 text-sm">Edit</button>
                        <button wire:click="delete({{ $client->id }})" wire:confirm="Are you sure?" class="text-red-600 hover:text-red-900 text-sm">Delete</button>
                    </div>
                </div>
                <div class="space-y-2 text-sm text-gray-600">
                    @if($client->email)
                        <p>📧 {{ $client->email }}</p>
                    @endif
                    @if($client->phone)
                        <p>📞 {{ $client->phone }}</p>
                    @endif
                </div>
                <div class="mt-4 pt-4 border-t border-gray-200 flex gap-4 text-xs text-gray-500">
                    <span>{{ $client->notes_count }} notes</span>
                    <span>{{ $client->tasks_count }} tasks</span>
                    <span>{{ $client->leads_count }} leads</span>
                </div>
                <div class="mt-4">
                    <a href="{{ route('clients.notes', $client->id) }}" class="text-knight-600 hover:text-knight-900 text-sm font-medium">View Details →</a>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center py-12">
                <p class="text-gray-500">No clients found.</p>
            </div>
        @endforelse
    </div>

    {{ $clients->links('livewire::tailwind') }}

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
                    <h3 class="text-xl font-semibold text-white">{{ $editingClient ? 'Edit Client' : 'New Client' }}</h3>
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
                            <label class="block text-sm font-medium text-gray-700">Name *</label>
                            <input type="text" wire:model="name" class="mt-1 block w-full px-3 py-2 rounded-md border-2 border-gray-300 shadow-sm focus:border-knight-500 focus:ring-knight-500">
                            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" wire:model="email" class="mt-1 block w-full px-3 py-2 rounded-md border-2 border-gray-300 shadow-sm focus:border-knight-500 focus:ring-knight-500">
                            @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Phone</label>
                            <input type="text" wire:model="phone" class="mt-1 block w-full px-3 py-2 rounded-md border-2 border-gray-300 shadow-sm focus:border-knight-500 focus:ring-knight-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Company</label>
                            <input type="text" wire:model="company" class="mt-1 block w-full px-3 py-2 rounded-md border-2 border-gray-300 shadow-sm focus:border-knight-500 focus:ring-knight-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Address</label>
                            <textarea wire:model="address" rows="2" class="mt-1 block w-full px-3 py-2 rounded-md border-2 border-gray-300 shadow-sm focus:border-knight-500 focus:ring-knight-500"></textarea>
                        </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="bg-gray-50 px-6 py-4 flex justify-end gap-3 border-t">
                        <button type="button" wire:click="closeModal" class="px-4 py-2 bg-white border-2 border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-knight-500">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-knight-600 text-white rounded-lg hover:bg-knight-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-knight-500">
                            {{ $editingClient ? 'Update Client' : 'Create Client' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>

