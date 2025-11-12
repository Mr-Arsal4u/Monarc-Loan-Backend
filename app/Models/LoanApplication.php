<?php

namespace App\Models;

use App\BorrowerType;
use App\LoanType;
use App\LoanPurpose;
use App\LoanStatus;
use App\Traits\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoanApplication extends Model
{
    use SoftDeletes, HasMedia;

    protected $fillable = [
        'user_id',
        'loan_type',
        'loan_purpose',
        'loan_amount',
        'certificate_of_business_purpose',
        'status',
        'progress_step',
        'completed_steps',
        'last_filled_step',
        'last_filled_at',
        'percent_complete',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
            'loan_type' => LoanType::class,
            'loan_purpose' => LoanPurpose::class,
            'status' => LoanStatus::class,
            'completed_steps' => 'array',
            'metadata' => 'array',
            'last_filled_at' => 'datetime',
            'percent_complete' => 'decimal:2',
            'loan_amount' => 'decimal:2',
        ];
    }

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function borrowers(): HasMany
    {
        return $this->hasMany(LoanBorrower::class);
    }

    public function primaryBorrower(): HasOne
    {
        return $this->hasOne(LoanBorrower::class)->where('borrower_type', BorrowerType::PRIMARY->value);
    }

    public function coBorrowers(): HasMany
    {
        return $this->hasMany(LoanBorrower::class)->where('borrower_type', BorrowerType::CO_BORROWER->value);
    }

    public function property(): HasOne
    {
        return $this->hasOne(Property::class);
    }

    public function assetLiability(): HasOne
    {
        return $this->hasOne(AssetLiability::class);
    }

    public function financialStatement(): HasOne
    {
        return $this->hasOne(FinancialStatement::class);
    }

    public function authorizedSigners(): HasMany
    {
        return $this->hasMany(AuthorizedSigner::class);
    }

    public function collaterals(): HasMany
    {
        return $this->hasMany(Collateral::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(LoanDocument::class);
    }

    public function notes(): HasMany
    {
        return $this->hasMany(LoanNote::class);
    }

    public function statusHistories(): HasMany
    {
        return $this->hasMany(LoanStatusHistory::class)->orderBy('changed_at', 'desc');
    }
}
