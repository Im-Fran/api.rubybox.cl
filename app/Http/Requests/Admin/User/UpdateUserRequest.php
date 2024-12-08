<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest {
    public function rules(): array {
        return [
            'name' => ['sometimes', 'required'],
            'email' => ['sometimes', 'required', 'email'],
            'password' => ['sometimes', 'required', 'min:8'],
        ];
    }
}
