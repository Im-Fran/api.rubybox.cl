<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Resources\Account\UserResource;
use Illuminate\Http\Request;

class AccountController extends Controller {
    public function show(Request $request) {
        return new UserResource(auth()->user());
    }
}
