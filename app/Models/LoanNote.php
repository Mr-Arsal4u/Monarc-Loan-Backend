<?php

namespace App\Models;

use App\NoteVisibility;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoanNote extends Model
{
    protected $fillable = [
        'loan_application_id',
        'author_id',
        'note',
        'visibility',
        'meta',
    ];

    protected function casts(): array
    {
        return [
            'visibility' => NoteVisibility::class,
            'meta' => 'array',
        ];
    }

    // Relationships
    public function loanApplication(): BelongsTo
    {
        return $this->belongsTo(LoanApplication::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
