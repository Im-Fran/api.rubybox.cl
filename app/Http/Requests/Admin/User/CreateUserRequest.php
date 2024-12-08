<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest {
    public function rules(): array {
        return [
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
        ];
    }

    public function attributes(): array {
        return [
            'name' => __('Name'),
            'email' => __('Email'),
            'password' => __('Password'),
        ];
    }
}
