<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Permission\CreatePermissionRequest;
use App\Http\Requests\Admin\Permission\UpdatePermissionRequest;
use App\Http\Resources\Admin\PermissionResource;
use App\Models\Permission;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class PermissionController extends Controller {
    public function index(Request $request) {
        return QueryBuilder::for(Permission::class)
            ->allowedFilters(['name'])
            ->allowedSorts(['name', 'created_at', 'updated_at'])
            ->jsonPaginate();
    }

    public function store(CreatePermissionRequest $request) {
        $data = $request->validated();
        $permission = Permission::create($data);

        return new PermissionResource($permission);
    }

    public function show(Permission $permission) {
        return new PermissionResource($permission);
    }

    public function update(UpdatePermissionRequest $request, Permission $permission) {
        $data = $request->validated();
        $permission->update($data);

        return new PermissionResource($permission);
    }

    public function destroy(Permission $permission) {
        $permission->delete();

        return response()->noContent();
    }
}
