<?php

namespace Tests\Feature\Business\Category;

use App\Models\Business\Business;
use App\Models\Business\BusinessCategory;
use App\Models\User;
use Database\Seeders\PermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateBusinessCategoryTest extends TestCase {
    use RefreshDatabase;

    private array $fakeData = [
        'name' => 'Test Category',
        'description' => 'Test Description',
    ];

    /* Prueba que un usuario puede crear una categoría de negocio */
    public function test_can_create_business_category() {
        $user = User::factory()->create();
        $business = Business::factory()->create(['user_id' => $user->id]);
        $this->seed([PermissionsSeeder::class]);
        $user->givePermissionTo('business.category.create');

        $response = $this->actingAs($user)->postJson(route('business.categories.store', ['business' => $business]), [
            ...$this->fakeData,
            'business_id' => $user->businesses->first->id,
        ]);

        $this->assertAuthenticated();
        $response->assertCreated();
    }

    /* Prueba que un usuario crea una categoría de negocio dentro de otra categoría */
    public function test_can_create_business_category_inside_another_category() {
        $user = User::factory()->create();
        $business = Business::factory()->create(['user_id' => $user->id]);
        $this->seed([PermissionsSeeder::class]);
        $user->givePermissionTo('business.category.create');

        $parentCategory = BusinessCategory::factory()->create([
            'business_id' => $business->id,
        ]);

        $response = $this->actingAs($user)->postJson(route('business.categories.store', ['business' => $business]), [
            ...$this->fakeData,
            'business_id' => $user->businesses->first()->id,
            'parent_id' => $parentCategory->id,
        ]);

        $this->assertAuthenticated();
        $response->assertCreated();
    }

    /* Prueba que un usuario no puede crear una categoría de negocio sin permisos */
    public function test_cannot_create_category_without_permissions() {
        $user = User::factory()->create();
        $business = Business::factory()->create(['user_id' => $user->id]);
        $response = $this->actingAs($user)->postJson(route('business.categories.store', ['business' => $business]), $this->fakeData);
        $this->seed([PermissionsSeeder::class]);

        $this->assertAuthenticated();
        $response->assertStatus(403);
    }

    /* Prueba que un usuario no puede crear una categoría en un negocio que no le pertenece */
    public function test_cannot_create_category_in_another_user_business() {
        $user = User::factory()->create();
        $anotherUser = User::factory()->create();
        $business = Business::factory()->create([
            'user_id' => $anotherUser->id,
        ]);
        $this->seed([PermissionsSeeder::class]);
        $user->givePermissionTo('business.category.create');

        $response = $this->actingAs($user)->postJson(route('business.categories.store', ['business' => $business]), $this->fakeData);

        $this->assertAuthenticated();
        $response->assertStatus(403);
    }
}
