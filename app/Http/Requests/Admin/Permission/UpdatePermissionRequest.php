<?php

namespace App\Http\Requests\Admin\Permission;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePermissionRequest extends FormRequest {
    public function rules(): array {
        return [
            'name' => ['sometimes', 'required'],
        ];
    }
}
