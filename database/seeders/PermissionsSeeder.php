<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder {

    public function run(): void {
        $data = config('permission.default_roles');

        foreach ($data as $role => $permissions) {
            collect($permissions)->map(fn($permission) => Permission::firstOrCreate(['name' => $permission]))->toArray();
            Role::firstOrCreate(['name' => $role])->givePermissionTo($permissions);
        }
    }
}
