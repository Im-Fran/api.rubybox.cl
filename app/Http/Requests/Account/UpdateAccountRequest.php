<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountRequest extends FormRequest {
    public function rules(): array {
        return [
            'name' => ['sometimes', 'required'],
            'email' => ['sometimes', 'required', 'email', 'max:254'],
            'password' => ['sometimes', 'required'],
        ];
    }
}
