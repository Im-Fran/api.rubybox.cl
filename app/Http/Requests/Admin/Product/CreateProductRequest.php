<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest {
    public function rules(): array {
        return [
            'name' => ['required'],
            'barcode' => ['required'],
            'description' => ['required'],
            'bill_name' => ['required'],
            'estimated_product_duration' => ['required'],
        ];
    }
}
