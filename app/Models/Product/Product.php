<?php

namespace App\Models\Product;

use App\Models\Business\Business;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model {
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'business_id',
        'barcode',
        'name',
        'description',
        'bill_name',
        'estimated_product_duration',
    ];

    protected function casts(): array {
        return [
            'id' => 'string',
            'business_id' => 'string',
        ];
    }

    public function business(): BelongsTo {
        return $this->belongsTo(Business::class);
    }
}
