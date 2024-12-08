<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Business\Business;
use App\Models\Permission;
use App\Models\Product\Product;
use App\Models\Role;
use App\Models\User;

class DashboardController extends Controller {
    public function index() {
        return [
            'users' => User::count(),
            'roles' => Role::count(),
            'permissions' => Permission::count(),
            'businesses' => Business::count(),
            'products' => Product::count(),
        ];
    }
}
