<?php

namespace App\Models\Business;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model {
    use HasFactory,
        HasUuids,
        SoftDeletes;

    protected $fillable = [
        'business_id',
        'address_line_1',
        'address_line_2',
        'street_reference',
        'country',
        'province',
        'city',
        'region',
        'postal_code',
        'latitude',
        'longitude',
    ];

    protected function casts(): array {
        return [
            'business_id' => 'string',
        ];
    }

    public function business(): BelongsTo {
        return $this->belongsTo(Business::class);
    }
}
