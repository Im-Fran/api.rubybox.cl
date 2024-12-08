<?php

namespace App\Http\Requests\Admin\Role;

use Illuminate\Foundation\Http\FormRequest;

class CreateRoleRequest extends FormRequest {
    public function rules(): array {
        return [
            'name' => ['required'],
        ];
    }

    public function attributes(): array {
        return [
            'name' => __('Name'),
        ];
    }
}
