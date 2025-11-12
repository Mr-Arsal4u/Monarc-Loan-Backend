<?php

namespace App\Models;

use App\CollateralType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Collateral extends Model
{
    protected $fillable = [
        'loan_application_id',
        'collateral_type',
        'collateral_description',
        'estimated_collateral_value',
        'existing_liens',
        'estimated_market_value',
        'property_address',
        'additional_data',
    ];

    protected function casts(): array
    {
        return [
            'collateral_type' => CollateralType::class,
            'estimated_collateral_value' => 'decimal:2',
            'existing_liens' => 'decimal:2',
            'estimated_market_value' => 'decimal:2',
            'additional_data' => 'array',
        ];
    }

    // Relationships
    public function loanApplication(): BelongsTo
    {
        return $this->belongsTo(LoanApplication::class);
    }
}
