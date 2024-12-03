<?php

namespace App\Models\Product;

use App\Models\Business\Business;
use Cog\Contracts\Ownership\Ownable;
use Cog\Laravel\Ownership\Traits\HasOwner;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model implements Ownable {
    use HasFactory,
        HasOwner,
        HasUuids,
        SoftDeletes;

    protected string $ownerModel = Business::class;

    protected string $ownerPrimaryKey = 'id';

    protected string $ownerForeignKey = 'business_id';

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
