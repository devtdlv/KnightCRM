<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
        'status',
        'value',
        'source',
        'notes',
        'client_id',
    ];

    protected $casts = [
        'value' => 'decimal:2',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function reminders(): HasMany
    {
        return $this->hasMany(Reminder::class);
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'new' => 'bg-gray-100 text-gray-800',
            'contacted' => 'bg-blue-100 text-blue-800',
            'qualified' => 'bg-purple-100 text-purple-800',
            'proposal' => 'bg-yellow-100 text-yellow-800',
            'negotiation' => 'bg-orange-100 text-orange-800',
            'won' => 'bg-green-100 text-green-800',
            'lost' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }
}

