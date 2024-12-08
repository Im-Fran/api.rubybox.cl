<?php

namespace App\Models\Business;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BusinessCategory extends Model {
    use HasFactory,
        HasUuids;

    protected $fillable = [
        'parent_id',
        'business_id',
        'name',
        'description',
    ];

    protected function casts(): array {
        return [
            'parent_id' => 'string',
        ];
    }

    public function business(): BelongsTo {
        return $this->belongsTo(Business::class);
    }

    public function parent(): BelongsTo {
        return $this->belongsTo(BusinessCategory::class, 'parent_id');
    }

    public function children(): HasMany {
        return $this->hasMany(BusinessCategory::class, 'parent_id');
    }
}
