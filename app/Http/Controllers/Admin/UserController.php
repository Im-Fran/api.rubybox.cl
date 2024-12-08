<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\CreateUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Http\Resources\Admin\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller {
    public function index(Request $request) {
        return QueryBuilder::for(User::class)
            ->allowedFilters(['name', 'email'])
            ->allowedSorts(['name', 'created_at', 'updated_at'])
            ->jsonPaginate();
    }

    public function store(CreateUserRequest $request) {
        $data = $request->validated();
        $user = User::create($data);

        return new UserResource($user);
    }

    public function show(User $user) {
        return new UserResource($user);
    }

    public function update(UpdateUserRequest $request, User $user) {
        $data = $request->validated();
        $user->update($data);

        return new UserResource($user);
    }

    public function destroy(User $user) {
        $user->delete();

        return response()->noContent();
    }
}
