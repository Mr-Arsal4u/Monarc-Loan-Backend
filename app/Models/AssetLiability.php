<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssetLiability extends Model
{
    protected $fillable = [
        'loan_application_id',
        'checking_account_balance',
        'savings_account_balance',
        'retirement_account',
        'stocks_investments',
        'other_assets',
        'existing_mortgage_debt',
        'car_loans',
        'credit_card_debt',
        'other_debts',
        'additional_data',
    ];

    protected function casts(): array
    {
        return [
            'checking_account_balance' => 'decimal:2',
            'savings_account_balance' => 'decimal:2',
            'retirement_account' => 'decimal:2',
            'stocks_investments' => 'decimal:2',
            'other_assets' => 'decimal:2',
            'existing_mortgage_debt' => 'decimal:2',
            'car_loans' => 'decimal:2',
            'credit_card_debt' => 'decimal:2',
            'other_debts' => 'decimal:2',
            'additional_data' => 'array',
        ];
    }

    // Relationships
    public function loanApplication(): BelongsTo
    {
        return $this->belongsTo(LoanApplication::class);
    }
}
