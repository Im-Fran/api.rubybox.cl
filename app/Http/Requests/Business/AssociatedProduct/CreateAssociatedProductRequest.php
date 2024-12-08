<?php

namespace App\Http\Requests\Business\AssociatedProduct;

use Illuminate\Foundation\Http\FormRequest;

class CreateAssociatedProductRequest extends FormRequest {

    public function rules(): array {
        return [
            'business_id' => ['required'],
            'category_id' => ['nullable'],
            'product_id' => ['required'],
        ];
    }

    public function attributes(): array {
        return [
            'business_id' => __('Business'),
            'category_id' => __('Category'),
            'product_id' => __('Product'),
        ];
    }

    public function authorize(): bool {
        return $this->business->isOwnedBy(auth()->user());
    }
}
