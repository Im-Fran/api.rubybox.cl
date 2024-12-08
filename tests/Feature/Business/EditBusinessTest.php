<?php

namespace Tests\Feature\Business;

use App\Models\Business\Address;
use App\Models\User;
use Database\Seeders\PermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditBusinessTest extends TestCase {
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

    public function test_user_can_edit_business() {
        $user = User::factory()->create();
        $this->seed([PermissionsSeeder::class]);
        $user->assignRole('user');
        $business = $user->businesses()->create($this->fakeData['business']);
        $business->address()->create($this->fakeData['address']);

        $response = $this->actingAs($user)->patchJson(route('business.update', [$business]), [
            'business' => [
                'name' => 'Mi Nuevo Negocio',
            ],
            'address' => [
                'address_line_1' => 'Nueva Dirección',
            ],
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment(['name' => 'Mi Nuevo Negocio']);
    }

    public function test_user_cannot_edit_another_users_business() {
        $user = User::factory()->create();
        $anotherUser = User::factory()->create();
        $this->seed([PermissionsSeeder::class]);
        $user->assignRole('user');
        $anotherUser->assignRole('user');
        $business = $user->businesses()->create($this->fakeData['business']);
        $business->address()->create($this->fakeData['address']);

        $response = $this->actingAs($anotherUser)->patchJson(route('business.update', [$business]), [
            'business' => [
                'name' => 'Mi Nuevo Negocio',
            ],
            'address' => [
                'address_line_1' => 'Nueva Dirección',
            ],
        ]);

        $response->assertStatus(403);
    }
}
