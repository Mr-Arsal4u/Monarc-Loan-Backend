<?php

namespace App\Models;

use App\AddressType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Address extends Model
{
    protected $fillable = [
        'addressable_type',
        'addressable_id',
        'type',
        'street',
        'unit',
        'city',
        'state',
        'zip',
        'country',
        'years_at_address',
        'months_at_address',
        'additional_data',
    ];

    protected function casts(): array
    {
        return [
            'type' => AddressType::class,
            'additional_data' => 'array',
        ];
    }

    // Relationships
    public function addressable(): MorphTo
    {
        return $this->morphTo();
    }
}
