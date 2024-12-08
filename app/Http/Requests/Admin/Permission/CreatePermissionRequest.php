<?php

namespace App\Http\Requests\Admin\Permission;

use Illuminate\Foundation\Http\FormRequest;

class CreatePermissionRequest extends FormRequest {
    public function rules(): array {
        return [
            'name' => ['required'],
        ];
    }
}
