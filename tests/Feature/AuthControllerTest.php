<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_login_with_valid_credentials()
    {
        $user = \App\Models\User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'), 
        ]);

        $response = $this->post('api/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertTrue(Auth::check());
    }
    public function test_user_cannot_login_with_invalid_credentials()
    {
        $response = $this->post('api/login', [
            'email' => 'invalid@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertRedirect('/');
        $response->assertSessionHasErrors('email');
        $this->assertFalse(Auth::check());
    }

    public function test_user_can_logout()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('api/logout');

        $response->assertRedirect('/');
        $this->assertFalse(Auth::check());
    }
}
