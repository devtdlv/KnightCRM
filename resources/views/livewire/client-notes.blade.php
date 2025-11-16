<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">{{ $client->name }}</h2>
            <p class="text-gray-500">{{ $client->company ?? 'No company' }}</p>
        </div>
        <a href="{{ route('clients.index') }}" class="text-knight-600 hover:text-knight-900">← Back to Clients</a>
    </div>

    <!-- Client Info -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold mb-4">Contact Information</h3>
        <div class="grid grid-cols-2 gap-4 text-sm">
            @if($client->email)
                <div>
                    <span class="text-gray-500">Email:</span>
                    <span class="ml-2 text-gray-900">{{ $client->email }}</span>
                </div>
            @endif
            @if($client->phone)
                <div>
                    <span class="text-gray-500">Phone:</span>
                    <span class="ml-2 text-gray-900">{{ $client->phone }}</span>
                </div>
            @endif
            @if($client->address)
                <div class="col-span-2">
                    <span class="text-gray-500">Address:</span>
                    <span class="ml-2 text-gray-900">{{ $client->address }}</span>
                </div>
            @endif
        </div>
    </div>

    <!-- Add Note Form -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold mb-4">{{ $editingNoteId ? 'Edit Note' : 'Add Note' }}</h3>
        <form wire:submit.prevent="saveNote">
            <textarea wire:model="content" rows="4" placeholder="Write a note about this client..." class="w-full px-3 py-2 rounded-md border-2 border-gray-300 shadow-sm focus:border-knight-500 focus:ring-knight-500"></textarea>
            @error('content') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            <div class="mt-4 flex gap-2">
                <button type="submit" class="px-4 py-2 bg-knight-600 text-white rounded-lg hover:bg-knight-700">
                    {{ $editingNoteId ? 'Update Note' : 'Add Note' }}
                </button>
                @if($editingNoteId)
                    <button type="button" wire:click="cancelEdit" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">Cancel</button>
                @endif
            </div>
        </form>
    </div>

    <!-- Notes List -->
    <div class="space-y-4">
        <h3 class="text-lg font-semibold text-gray-900">Notes ({{ $client->notes->count() }})</h3>
        @forelse($client->notes->sortByDesc('created_at') as $note)
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex justify-between items-start mb-2">
                    <p class="text-sm text-gray-500">{{ $note->created_at->format('M d, Y h:i A') }}</p>
                    <div class="flex gap-2">
                        <button wire:click="editNote({{ $note->id }})" class="text-knight-600 hover:text-knight-900 text-sm">Edit</button>
                        <button wire:click="deleteNote({{ $note->id }})" wire:confirm="Are you sure?" class="text-red-600 hover:text-red-900 text-sm">Delete</button>
                    </div>
                </div>
                <p class="text-gray-900 whitespace-pre-wrap">{{ $note->content }}</p>
            </div>
        @empty
            <div class="bg-white rounded-lg shadow p-6 text-center text-gray-500">
                No notes yet. Add your first note above!
            </div>
        @endforelse
    </div>
</div>

