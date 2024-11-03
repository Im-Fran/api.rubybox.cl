<?php

namespace App\Http\Resources\Product;

use App\Models\Product\BusinessAssociatedProduct;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin BusinessAssociatedProduct */
class BusinessAssociatedProductResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'id' => $this->id,
            'business_id' => $this->business_id,
            'category_id' => $this->category_id,
            'product_id' => $this->product_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
