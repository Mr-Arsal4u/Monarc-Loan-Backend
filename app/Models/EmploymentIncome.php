<?php

namespace App\Models;

use App\EmploymentStatus;
use App\OwnershipShare;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmploymentIncome extends Model
{
    protected $fillable = [
        'loan_borrower_id',
        'employment_status',
        'employer_business_name',
        'job_title',
        'start_date',
        'work_phone',
        'years_employed',
        'months_employed',
        'years_in_line_of_work',
        'months_in_line_of_work',
        'is_business_owner',
        'is_employed_by_family_member',
        'ownership_share',
        'industry',
        'base_income',
        'overtime_income',
        'bonus_income',
        'commission_income',
        'military_entitlements',
        'other_income',
        'total_monthly_income',
        'additional_data',
    ];

    protected function casts(): array
    {
        return [
            'employment_status' => EmploymentStatus::class,
            'ownership_share' => OwnershipShare::class,
            'start_date' => 'date',
            'is_business_owner' => 'boolean',
            'is_employed_by_family_member' => 'boolean',
            'base_income' => 'decimal:2',
            'overtime_income' => 'decimal:2',
            'bonus_income' => 'decimal:2',
            'commission_income' => 'decimal:2',
            'military_entitlements' => 'decimal:2',
            'other_income' => 'decimal:2',
            'total_monthly_income' => 'decimal:2',
            'additional_data' => 'array',
        ];
    }

    // Relationships
    public function loanBorrower(): BelongsTo
    {
        return $this->belongsTo(LoanBorrower::class);
    }
}
