<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPrices extends Model {
    use // HasFactory,
        HasUuids;

    protected function casts(): array {
        return [
            'product_id' => 'string',
            'business_id' => 'string',
        ];
    }
}
