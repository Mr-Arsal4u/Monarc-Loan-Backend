<?php

namespace App\Models;

use App\ContactQueryStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactQuery extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'status',
        'is_read',
        'read_at',
        'read_by',
        'internal_notes',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
            'status' => ContactQueryStatus::class,
            'is_read' => 'boolean',
            'read_at' => 'datetime',
            'metadata' => 'array',
        ];
    }

    /**
     * Get the user who read this query.
     */
    public function readBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'read_by');
    }

    /**
     * Mark the query as read.
     */
    public function markAsRead(?int $userId = null): void
    {
        $this->update([
            'is_read' => true,
            'read_at' => now(),
            'read_by' => $userId ?? Auth::id(),
            'status' => $this->status === ContactQueryStatus::NEW ? ContactQueryStatus::READ : $this->status,
        ]);
    }

    /**
     * Archive the query.
     */
    public function archive(): void
    {
        $this->update(['status' => ContactQueryStatus::ARCHIVED]);
    }

    /**
     * Scope to get unread queries.
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Scope to get read queries.
     */
    public function scopeRead($query)
    {
        return $query->where('is_read', true);
    }

    /**
     * Scope to filter by status.
     */
    public function scopeStatus($query, ContactQueryStatus|string $status)
    {
        $statusValue = $status instanceof ContactQueryStatus ? $status->value : $status;
        return $query->where('status', $statusValue);
    }

    /**
     * Scope to get new queries.
     */
    public function scopeNew($query)
    {
        return $query->where('status', ContactQueryStatus::NEW->value);
    }

    /**
     * Scope to get archived queries.
     */
    public function scopeArchived($query)
    {
        return $query->where('status', ContactQueryStatus::ARCHIVED->value);
    }
}
