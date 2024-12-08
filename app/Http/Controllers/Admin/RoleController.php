<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\CreateRoleRequest;
use App\Http\Requests\Admin\Role\UpdateRoleRequest;
use App\Http\Resources\Admin\RoleResource;
use App\Models\Role;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class RoleController extends Controller {
    public function index(Request $request) {
        return QueryBuilder::for(Role::class)
            ->allowedFilters(['name'])
            ->allowedSorts(['name', 'created_at', 'updated_at'])
            ->jsonPaginate();
    }

    public function store(CreateRoleRequest $request) {
        $data = $request->validated();
        $role = Role::create($data);

        return new RoleResource($role);
    }

    public function show(Role $role) {
        return new RoleResource($role);
    }

    public function update(UpdateRoleRequest $request, Role $role) {
        $data = $request->validated();
        $role->update($data);

        return new RoleResource($role);
    }

    public function destroy(Role $role) {
        $role->delete();

        return response()->noContent();
    }
}
