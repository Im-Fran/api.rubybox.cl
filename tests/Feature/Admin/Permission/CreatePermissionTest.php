<?php

namespace Tests\Feature\Admin\Permission;

use App\Models\User;
use Database\Seeders\PermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreatePermissionTest extends TestCase {
    use RefreshDatabase;

    private array $fakeData = [
        'name' => 'Test Permission',
    ];

    public function test_can_create_permission() {
        $user = User::factory()->create();
        $this->seed([PermissionsSeeder::class]);
        $user->givePermissionTo('admin.dashboard', 'admin.permissions.create');

        $response = $this->actingAs($user)->postJson(route('admin.permissions.store'), $this->fakeData);

        $this->assertAuthenticated();
        $response->assertCreated();
    }

    public function test_cannot_create_permission_without_permissions() {
        $user = User::factory()->create();
        $this->seed([PermissionsSeeder::class]);
        $response = $this->actingAs($user)->postJson(route('admin.permissions.store'), $this->fakeData);

        $this->assertAuthenticated();
        $response->assertStatus(403);
    }
}