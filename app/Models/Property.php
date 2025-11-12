<?php

namespace App\Models;

use App\PropertyType;
use App\CollateralType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Property extends Model
{
    protected $fillable = [
        'loan_application_id',
        'property_address',
        'city',
        'state',
        'zip',
        'property_type',
        'purchase_price',
        'down_payment',
        'desired_loan_amount',
        'interest_rate',
        'loan_term',
        'collateral_type',
        'estimated_collateral_value',
        'collateral_description',
        'existing_liens',
        'estimated_market_value',
        'additional_data',
    ];

    protected function casts(): array
    {
        return [
            'property_type' => PropertyType::class,
            'collateral_type' => CollateralType::class,
            'purchase_price' => 'decimal:2',
            'down_payment' => 'decimal:2',
            'desired_loan_amount' => 'decimal:2',
            'interest_rate' => 'decimal:2',
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
