<?php

namespace App\Http\Resources\Business;

use App\Models\Business\BusinessCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin BusinessCategory */
class BusinessCategoryResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'business_id' => $this->business_id,
            'name' => $this->name,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
