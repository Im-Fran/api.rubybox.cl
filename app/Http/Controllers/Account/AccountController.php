<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Account\UserResource;

class AccountController extends Controller {
    
    public function show(Request $request) {
        return new UserResource(auth()->user());
    }
}
