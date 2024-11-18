<?php

namespace App\Http\Requests\Business;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBusinessRequest extends FormRequest {
    public function rules(): array {
        return [
            'business.name' => ['filled'],

            'address.line_1' => ['filled'],
            'address.line_2' => ['nullable'],
            'address.street_reference' => ['filled'],
            'address.country' => ['filled'],
            'address.province' => ['filled'],
            'address.city' => ['filled'],
            'address.region' => ['filled'],
            'address.postal_code' => ['filled'],
            'address.latitude' => ['filled'],
            'address.longitude' => ['filled'],
        ];
    }

    public function authorize(): bool {
        return auth()->check();
    }
}
