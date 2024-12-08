<?php

namespace Tests\Feature\Admin\Product;

use App\Models\User;
use Database\Seeders\PermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateProductTest extends TestCase {
    use RefreshDatabase;

    private array $fakeData = [
        'name' => 'Test Product',
        'description' => 'Test Description',
        'bill_name' => 'Test Bill Name',
        'barcode' => '123456789',
        'estimated_product_duration' => 1,
    ];

    public function test_can_create_product() {
        $user = User::factory()->create();
        $this->seed([PermissionsSeeder::class]);
        $user->givePermissionTo('admin.dashboard', 'admin.products.create');

        $response = $this->actingAs($user)->postJson(route('admin.products.store'), $this->fakeData);

        $this->assertAuthenticated();
        $response->assertCreated();
    }

    public function test_cannot_create_product_without_permissions() {
        $user = User::factory()->create();
        $this->seed([PermissionsSeeder::class]);

        $response = $this->actingAs($user)->postJson(route('admin.products.store'), $this->fakeData);

        $this->assertAuthenticated();
        $response->assertStatus(403);
    }
}
