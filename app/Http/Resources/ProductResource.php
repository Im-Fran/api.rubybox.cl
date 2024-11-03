<?php

namespace App\Http\Resources;

use App\Models\Product\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Product */
class ProductResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'id' => $this->id,
            'business_id' => $this->business_id,
            'barcode' => $this->barcode,
            'name' => $this->name,
            'description' => $this->description,
            'bill_name' => $this->bill_name,
            'estimated_product_duration' => $this->estimated_product_duration,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
