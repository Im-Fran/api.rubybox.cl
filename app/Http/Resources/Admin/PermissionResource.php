<?php

namespace App\Http\Resources\Admin;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Permission */
class PermissionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'permissions_count' => $this->permissions_count,
            'roles_count' => $this->roles_count,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'permissions' => PermissionResource::collection($this->whenLoaded('permissions')),
            'roles' => RoleResource::collection($this->whenLoaded('roles')),

        ];
    }
}
