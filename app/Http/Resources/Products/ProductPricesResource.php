<?php

namespace App\Http\Resources\Products;

use App\Models\Product\ProductPrices;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin ProductPrices */
class ProductPricesResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'business_id' => $this->business_id,
            'price' => $this->price,
            'currency' => $this->currency,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
