<?php

namespace App\Http\Resources\Business;

use App\Models\Business\Address;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Address */
class AddressResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'id' => $this->id,
            'address_line_1' => $this->address_line_1,
            'address_line_2' => $this->address_line_2,
            'street_reference' => $this->street_reference,
            'province' => $this->province,
            'city' => $this->city,
            'region' => $this->region,
            'postal_code' => $this->postal_code,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
