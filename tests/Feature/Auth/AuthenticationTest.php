<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/* Prueba las funcionalidades de autenticación. */
class AuthenticationTest extends TestCase {
    use RefreshDatabase;

    /* Prueba que unu usuario pueda iniciar sesión */
    public function test_users_can_authenticate_using_the_login_screen(): void {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertNoContent();
    }

    /* Prueba que un usuario no pueda autenticarse con una contraseña inválida */
    public function test_users_can_not_authenticate_with_invalid_password(): void {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    /* Prueba que un usuario pueda cerrar sesión */
    public function test_users_can_logout(): void {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/logout');

        $this->assertGuest();
        $response->assertNoContent();
    }
}
