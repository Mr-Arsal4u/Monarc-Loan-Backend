<?php

namespace App\Models;

use App\LoanStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoanStatusHistory extends Model
{
    protected $fillable = [
        'loan_application_id',
        'changed_by',
        'from_status',
        'to_status',
        'reason',
        'metadata',
        'changed_at',
    ];

    protected function casts(): array
    {
        return [
            'from_status' => LoanStatus::class,
            'to_status' => LoanStatus::class,
            'metadata' => 'array',
            'changed_at' => 'datetime',
        ];
    }

    // Relationships
    public function loanApplication(): BelongsTo
    {
        return $this->belongsTo(LoanApplication::class);
    }

    public function changedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}
