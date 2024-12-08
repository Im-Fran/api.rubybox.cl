<?php

namespace Tests\Feature\Business\Category;

use App\Models\Business\Business;
use App\Models\Business\BusinessCategory;
use App\Models\User;
use Database\Seeders\PermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FetchBusinessCategoryTest extends TestCase {
    use RefreshDatabase;

    /* Prueba que un usuario puede ver una categoría de negocio */
    public function test_can_fetch_business_category() {
        $user = User::factory()->create();
        $business = Business::factory()->create(['user_id' => $user->id]);
        $category = BusinessCategory::factory()->create(['business_id' => $business->id]);
        $this->seed([PermissionsSeeder::class]);
        $user->givePermissionTo('business.category.view');

        $response = $this->actingAs($user)->getJson(route('business.categories.show', ['business' => $business, 'category' => $category]));

        $this->assertAuthenticated();
        $response->assertOk();
        $response->assertJsonFragment([
            'id' => $category->id,
            'name' => $category->name,
            'description' => $category->description,
        ]);
    }

    /* Prueba que un usuario no puede ver una categoría de negocio sin permisos */
    public function test_cannot_fetch_category_without_permissions() {
        $user = User::factory()->create();
        $business = Business::factory()->create(['user_id' => $user->id]);
        $category = BusinessCategory::factory()->create(['business_id' => $business->id]);
        $this->seed([PermissionsSeeder::class]);

        $response = $this->actingAs($user)->getJson(route('business.categories.show', ['business' => $business, 'category' => $category]));

        $this->assertAuthenticated();
        $response->assertStatus(403);
    }

    /* Prueba que un usuario no puede ver una categoría en un negocio que no le pertenece */
    public function test_cannot_fetch_category_in_another_user_business() {
        $user = User::factory()->create();
        $anotherUser = User::factory()->create();
        $business = Business::factory()->create(['user_id' => $anotherUser->id]);
        $category = BusinessCategory::factory()->create(['business_id' => $business->id]);
        $this->seed([PermissionsSeeder::class]);
        $user->givePermissionTo('business.category.view');

        $response = $this->actingAs($user)->getJson(route('business.categories.show', ['business' => $business, 'category' => $category]));

        $this->assertAuthenticated();
        $response->assertStatus(403);
    }
}
