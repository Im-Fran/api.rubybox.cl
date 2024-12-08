<?php

namespace Tests\Feature\Business;

use App\Models\Business\Address;
use App\Models\User;
use Database\Seeders\PermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateBusinessTest extends TestCase {
    use RefreshDatabase;

    private array $fakeData = [
        'business' => [
            'name' => 'Mi Negocio',
        ],
        'address' => [
            'address_line_1' => 'Moneda',
            'street_reference' => 'S/N',
            'country' => 'Chile',
            'province' => 'Santiago',
            'city' => 'Santiago',
            'region' => 'Metropolitana',
            'postal_code' => '8320000',
            'latitude' => 33.44278,
            'longitude' => -70.65385,
        ],
    ];

    /* Prueba que un usuario pueda crear un negocio */
    public function test_can_create_business() {
        $user = User::factory()->create();
        $this->seed([PermissionsSeeder::class]);
        $user->givePermissionTo('business.create');

        $response = $this->actingAs($user)->postJson(route('business.store'), $this->fakeData);

        $this->assertAuthenticated();
        $response->assertCreated();
    }

    public function test_cannot_create_more_businesses() {
        $user = User::factory()->create();
        $this->seed([PermissionsSeeder::class]);
        $business = $user->businesses()->create($this->fakeData['business']);
        $business->address()->create($this->fakeData['address']);
        $user->givePermissionTo('business.create');

        $response = $this->actingAs($user)->postJson(route('business.store'), $this->fakeData);

        $this->assertAuthenticated();
        $response->assertStatus(400);
    }

    public function test_cannot_create_business_without_permissions() {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->postJson(route('business.store'), $this->fakeData);

        $this->assertAuthenticated();
        $response->assertStatus(403);
    }
}
