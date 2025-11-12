<?php

namespace App\Models;

use App\BorrowerType;
use App\CreditType;
use App\MaritalStatus;
use App\Citizenship;
use App\EntityType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoanBorrower extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'loan_application_id',
        'borrower_type',
        // Personal Information
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'ssn',
        'itin',
        'alternate_names',
        'date_of_birth',
        'credit_type',
        'total_borrowers',
        'other_borrower_names',
        'marital_status',
        'dependents_number',
        'dependents_ages',
        'citizenship',
        // Business/Entity Information
        'borrower_legal_name',
        'borrower_first_name',
        'borrower_dba_name',
        'entity_type',
        'state_of_organization',
        'date_of_filing',
        'filing_locations',
        // Contact Information
        'home_phone',
        'cell_phone',
        'work_phone',
        'work_phone_ext',
        'email',
        'main_contact_phone',
        'secondary_contact_phone',
        'fax',
        // Experience
        'years_experience_real_estate',
        'additional_data',
    ];

    protected function casts(): array
    {
        return [
            'borrower_type' => BorrowerType::class,
            'credit_type' => CreditType::class,
            'marital_status' => MaritalStatus::class,
            'citizenship' => Citizenship::class,
            'entity_type' => EntityType::class,
            'date_of_birth' => 'date',
            'date_of_filing' => 'date',
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

    public function employmentIncomes(): HasMany
    {
        return $this->hasMany(EmploymentIncome::class);
    }
}
