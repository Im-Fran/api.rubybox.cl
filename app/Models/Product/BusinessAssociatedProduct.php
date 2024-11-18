<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessAssociatedProduct extends Model {
    use //HasFactory,
        HasUuids;

    protected function casts(): array {
        return [
            'business_id' => 'string',
            'category_id' => 'string',
            'product_id' => 'string',
        ];
    }
}
