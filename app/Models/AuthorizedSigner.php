<?php

namespace App\Models;

use App\AuthorizedSignerTitle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class AuthorizedSigner extends Model
{
    protected $fillable = [
        'loan_application_id',
        'first_name',
        'last_name',
        'title',
        'ssn',
        'date_of_birth',
        'email',
        'phone',
        'ownership_percentage',
        'years_with_company',
        'additional_data',
    ];

    protected function casts(): array
    {
        return [
            'title' => AuthorizedSignerTitle::class,
            'date_of_birth' => 'date',
            'ownership_percentage' => 'decimal:2',
            'additional_data' => 'array',
        ];
    }

    // Relationships
    public function loanApplication(): BelongsTo
    {
        return $this->belongsTo(LoanApplication::class);
    }

    public function addresses(): MorphMany
    {
        return $this->morphMany(Address::class, 'addressable');
    }
}
