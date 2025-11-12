<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FinancialStatement extends Model
{
    protected $fillable = [
        'loan_application_id',
        'annual_revenue',
        'net_income',
        'total_business_assets',
        'total_business_liabilities',
        'working_capital',
        'accounts_receivable',
        'accounts_payable',
        'existing_debt_outstanding',
        'additional_data',
    ];

    protected function casts(): array
    {
        return [
            'annual_revenue' => 'decimal:2',
            'net_income' => 'decimal:2',
            'total_business_assets' => 'decimal:2',
            'total_business_liabilities' => 'decimal:2',
            'working_capital' => 'decimal:2',
            'accounts_receivable' => 'decimal:2',
            'accounts_payable' => 'decimal:2',
            'existing_debt_outstanding' => 'decimal:2',
            'additional_data' => 'array',
        ];
    }

    // Relationships
    public function loanApplication(): BelongsTo
    {
        return $this->belongsTo(LoanApplication::class);
    }
}
