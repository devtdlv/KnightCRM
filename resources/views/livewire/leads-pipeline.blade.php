<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-3xl font-bold text-gray-900">Leads Pipeline</h2>
        <div class="flex gap-2">
            <a href="{{ route('leads.export') }}" class="bg-knight-600 hover:bg-knight-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                Export CSV
            </a>
            <button wire:click="openModal" class="bg-knight-600 hover:bg-knight-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                + New Lead
            </button>
        </div>
    </div>

    <!-- Status Filter -->
    <div class="flex gap-2 flex-wrap">
        <button wire:click="$set('filterStatus', '')" class="px-4 py-2 rounded-lg text-sm font-medium {{ !$filterStatus ? 'bg-knight-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
            All
        </button>
        @foreach(['new', 'contacted', 'qualified', 'proposal', 'negotiation', 'won', 'lost'] as $status)
            <button wire:click="$set('filterStatus', '{{ $status }}')" class="px-4 py-2 rounded-lg text-sm font-medium {{ $filterStatus === $status ? 'bg-knight-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                {{ ucfirst($status) }} ({{ $statusCounts[$status] ?? 0 }})
            </button>
        @endforeach
    </div>

    <!-- Leads Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Company</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Value</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($leads as $lead)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $lead->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $lead->company ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $lead->email ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${{ number_format($lead->value ?? 0, 2) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <select wire:change="updateStatus({{ $lead->id }}, $event.target.value)" class="text-xs font-semibold rounded-full px-2 py-1 {{ $lead->status_color }}">
                                <option value="new" {{ $lead->status === 'new' ? 'selected' : '' }}>New</option>
                                <option value="contacted" {{ $lead->status === 'contacted' ? 'selected' : '' }}>Contacted</option>
                                <option value="qualified" {{ $lead->status === 'qualified' ? 'selected' : '' }}>Qualified</option>
                                <option value="proposal" {{ $lead->status === 'proposal' ? 'selected' : '' }}>Proposal</option>
                                <option value="negotiation" {{ $lead->status === 'negotiation' ? 'selected' : '' }}>Negotiation</option>
                                <option value="won" {{ $lead->status === 'won' ? 'selected' : '' }}>Won</option>
                                <option value="lost" {{ $lead->status === 'lost' ? 'selected' : '' }}>Lost</option>
                            </select>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button wire:click="openModal({{ $lead->id }})" class="text-knight-600 hover:text-knight-900 mr-3">Edit</button>
                            <button wire:click="delete({{ $lead->id }})" wire:confirm="Are you sure?" class="text-red-600 hover:text-red-900">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">No leads found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $leads->links('livewire::tailwind') }}

    <!-- Modal -->
    @if($showModal)
    <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" wire:click="closeModal"></div>

            <!-- Center modal -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!-- Modal panel -->
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full" wire:click.stop>
                <!-- Header -->
                <div class="bg-knight-600 px-6 py-4 flex justify-between items-center">
                    <h3 class="text-xl font-semibold text-white">{{ $editingLead ? 'Edit Lead' : 'New Lead' }}</h3>
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
                            <label class="block text-sm font-medium text-gray-700">Status *</label>
                            <select wire:model="status" class="mt-1 block w-full px-3 py-2 rounded-md border-2 border-gray-300 shadow-sm focus:border-knight-500 focus:ring-knight-500">
                                <option value="new">New</option>
                                <option value="contacted">Contacted</option>
                                <option value="qualified">Qualified</option>
                                <option value="proposal">Proposal</option>
                                <option value="negotiation">Negotiation</option>
                                <option value="won">Won</option>
                                <option value="lost">Lost</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Value</label>
                            <input type="number" step="0.01" wire:model="value" class="mt-1 block w-full px-3 py-2 rounded-md border-2 border-gray-300 shadow-sm focus:border-knight-500 focus:ring-knight-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Source</label>
                            <input type="text" wire:model="source" class="mt-1 block w-full px-3 py-2 rounded-md border-2 border-gray-300 shadow-sm focus:border-knight-500 focus:ring-knight-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Notes</label>
                            <textarea wire:model="notes" rows="3" class="mt-1 block w-full px-3 py-2 rounded-md border-2 border-gray-300 shadow-sm focus:border-knight-500 focus:ring-knight-500"></textarea>
                        </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="bg-gray-50 px-6 py-4 flex justify-end gap-3 border-t">
                        <button type="button" wire:click="closeModal" class="px-4 py-2 bg-white border-2 border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-knight-500">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-knight-600 text-white rounded-lg hover:bg-knight-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-knight-500">
                            {{ $editingLead ? 'Update Lead' : 'Create Lead' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>

