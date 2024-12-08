<?php

namespace Tests\Feature\Admin\User;

use App\Models\User;
use Database\Seeders\PermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateUserTest extends TestCase {
    use RefreshDatabase;

    private array $fakeData = [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
    ];

    public function test_can_create_user() {
        $user = User::factory()->create();
        $this->seed([PermissionsSeeder::class]);
        $user->givePermissionTo('admin.dashboard', 'admin.users.create');

        $response = $this->actingAs($user)->postJson(route('admin.users.store'), $this->fakeData);

        $this->assertAuthenticated();
        $response->assertCreated();
    }

    public function test_cannot_create_user_without_permissions() {
        $user = User::factory()->create();
        $this->seed([PermissionsSeeder::class]);

        $response = $this->actingAs($user)->postJson(route('admin.users.store'), $this->fakeData);

        $this->assertAuthenticated();
        $response->assertStatus(403);
    }
}