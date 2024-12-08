<?php

namespace Tests\Feature\Admin\Role;

use App\Models\User;
use Database\Seeders\PermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateRoleTest extends TestCase {
    use RefreshDatabase;

    private array $fakeData = [
        'name' => 'Test Role',
    ];

    public function test_can_create_role() {
        $user = User::factory()->create();
        $this->seed([PermissionsSeeder::class]);
        $user->givePermissionTo('admin.dashboard', 'admin.roles.create');

        $response = $this->actingAs($user)->postJson(route('admin.roles.store'), $this->fakeData);

        $this->assertAuthenticated();
        $response->assertCreated();
    }

    public function test_cannot_create_role_without_permissions() {
        $user = User::factory()->create();
        $this->seed([PermissionsSeeder::class]);
        $response = $this->actingAs($user)->postJson(route('admin.roles.store'), $this->fakeData);

        $this->assertAuthenticated();
        $response->assertStatus(403);
    }
}