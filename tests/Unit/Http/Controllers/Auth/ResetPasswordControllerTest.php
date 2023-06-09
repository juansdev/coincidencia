<?php

namespace Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class ResetPasswordControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testResetPasswordPageIsDisplayedWhenValidTokenIsPresent()
    {
        $user = User::factory()->create();
        $token = Password::createToken($user);

        $response = $this->get(route('password.reset', $token));

        $response->assertStatus(200);
        $response->assertViewIs('auth.passwords.reset');
        $response->assertViewHas('token', $token);
    }

    public function testResetPasswordWithValidCredentials()
    {
        $user = User::factory()->create();
        $token = Password::createToken($user);

        $response = $this->post(route('password.update'), [
            'token' => $token,
            'email' => $user->email,
            'password' => 'new-password',
            'password_confirmation' => 'new-password'
        ]);

        $response->assertRedirect(route('home'));
        $this->assertAuthenticatedAs($user);

        $this->assertTrue(
            Hash::check('new-password', $user->fresh()->password),
            'The password was not updated'
        );
    }

    public function testResetPasswordWithInvalidToken()
    {
        $user = User::factory()->create();
        $token = 'invalid-token';

        $response = $this->post(route('password.update'), [
            'token' => $token,
            'email' => $user->email,
            'password' => 'new-password',
            'password_confirmation' => 'new-password'
        ]);

        $response->assertSessionHasErrors('email');
    }

    public function testResetPasswordWithInvalidEmail()
    {
        $user = User::factory()->create();
        $token = Password::createToken($user);
        $invalidEmail = $this->faker->safeEmail;

        $response = $this->post(route('password.update'), [
            'token' => $token,
            'email' => $invalidEmail,
            'password' => 'new-password',
            'password_confirmation' => 'new-password'
        ]);

        $response->assertSessionHasErrors('email');
    }
}
