<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest {
    public function rules(): array {
        return [
            'name' => ['sometimes', 'required'],
            'barcode' => ['sometimes', 'required'],
            'description' => ['sometimes', 'required'],
            'bill_name' => ['sometimes', 'required'],
            'estimated_product_duration' => ['sometimes', 'required'],
        ];
    }

    public function attributes(): array {
        return [
            'name' => __('Name'),
            'barcode' => __('Barcode'),
            'description' => __('Description'),
            'bill_name' => __('Bill Name'),
            'estimated_product_duration' => __('Estimated Product Duration'),
        ];
    }
}
