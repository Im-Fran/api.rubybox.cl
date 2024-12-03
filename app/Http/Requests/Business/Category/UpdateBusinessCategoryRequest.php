<?php

namespace App\Http\Requests\Business\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBusinessCategoryRequest extends FormRequest {
    public function rules(): array {
        return [
            'parent_id' => ['nullable'],
            'name' => ['filled'],
            'description' => ['filled'],
        ];
    }

    public function authorize(): bool {
        return $this->business->isOwnedBy(auth()->user());
    }
}
