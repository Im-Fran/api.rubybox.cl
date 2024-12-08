<?php

namespace App\Http\Requests\Business;

use Illuminate\Foundation\Http\FormRequest;

class CreateBusinessRequest extends FormRequest {
    public function rules(): array {
        return [
            'business.name' => ['required'],

            'address.address_line_1' => ['required'],
            'address.address_line_2' => ['nullable'],
            'address.street_reference' => ['required'],
            'address.country' => ['required'],
            'address.province' => ['required'],
            'address.city' => ['required'],
            'address.region' => ['nullable'],
            'address.postal_code' => ['required'],
            'address.latitude' => ['nullable'],
            'address.longitude' => ['nullable'],
        ];
    }
}
