<?php

namespace App\Http\Requests\Business;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBusinessRequest extends FormRequest {
    public function rules(): array {
        return [
            'business.name' => ['sometimes', 'required'],

            'address.address_line_1' => ['sometimes', 'required'],
            'address.address_line_2' => ['nullable'],
            'address.street_reference' => ['sometimes', 'required'],
            'address.country' => ['sometimes', 'required'],
            'address.province' => ['sometimes', 'required'],
            'address.city' => ['sometimes', 'required'],
            'address.region' => ['nullable'],
            'address.postal_code' => ['sometimes', 'required'],
            'address.latitude' => ['nullable'],
            'address.longitude' => ['nullable'],
        ];
    }

    public function attributes(): array {
        return [
            'business.name' => __('Name'),

            'address.address_line_1' => __('Address Line 1'),
            'address.address_line_2' => __('Address Line 2'),
            'address.street_reference' => __('Street Reference'),
            'address.country' => __('Country'),
            'address.province' => __('Province'),
            'address.city' => __('City'),
            'address.region' => __('Region'),
            'address.postal_code' => __('Postal Code'),
            'address.latitude' => __('Latitude'),
            'address.longitude' => __('Longitude'),
        ];
    }
}
