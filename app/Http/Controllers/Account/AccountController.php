<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\UpdateAccountRequest;
use App\Http\Resources\Account\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller {
    /* Muestra los datos del usuario */
    public function show(Request $request) {
        return new UserResource($request->user());
    }

    /* Actualiza los datos del usuario */
    public function update(UpdateAccountRequest $request) {
        $user = auth()->user();
        $data = $request->validated();
        if ($data['password']) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        return new UserResource($user);
    }
}
