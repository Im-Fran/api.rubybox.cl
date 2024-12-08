<?php

namespace Tests\Feature\Business;

use App\Models\Business\Address;
use App\Models\User;
use Database\Seeders\PermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FetchBusinessTest extends TestCase {
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

    public function test_can_fetch_businesses() {
        $user = User::factory()->create();
        $this->seed([PermissionsSeeder::class]);

        $business = $user->businesses()->create($this->fakeData['business']);
        $business->address()->create($this->fakeData['address']);

        $response = $this->actingAs($user)->getJson(route('business.index'));

        $this->assertAuthenticated();
        $response->assertOk();
        $response->assertJsonFragment(['name' => $business->name]);
    }

    public function test_cannot_fetch_businesses_from_another_user() {
        $user = User::factory()->create();
        $anotherUser = User::factory()->create();
        $this->seed([PermissionsSeeder::class]);

        $business = $anotherUser->businesses()->create($this->fakeData['business']);
        $business->address()->create($this->fakeData['address']);

        $response = $this->actingAs($user)->getJson(route('business.index'));

        $this->assertAuthenticated();
        $response->assertOk();
        $response->assertJsonMissing(['name' => $business->name]);
    }
}
