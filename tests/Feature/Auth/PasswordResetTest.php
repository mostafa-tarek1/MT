<?php

namespace Tests\Feature\Auth;

use App\Modules\Auth\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test user can request password reset with valid email.
     */
    public function test_user_can_request_password_reset(): void
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
        ]);

        $response = $this->postJson('/api/v1/password/forgot', [
            'email' => 'test@example.com',
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('otps', [
            'email' => 'test@example.com',
        ]);
    }

    /**
     * Test password reset request fails with non-existing email.
     */
    public function test_password_reset_fails_with_non_existing_email(): void
    {
        $response = $this->postJson('/api/v1/password/forgot', [
            'email' => 'nonexisting@example.com',
        ]);

        $response->assertStatus(404);
    }

    /**
     * Test password reset validation fails without email.
     */
    public function test_password_reset_validation_fails_without_email(): void
    {
        $response = $this->postJson('/api/v1/password/forgot');

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }

    /**
     * Test password reset is rate limited.
     */
    public function test_password_reset_is_rate_limited(): void
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
        ]);

        // Make 4 requests (limit is 3 per minute)
        for ($i = 0; $i < 4; $i++) {
            $response = $this->postJson('/api/v1/password/forgot', [
                'email' => 'test@example.com',
            ]);

            if ($i < 3) {
                $this->assertContains($response->status(), [200, 400]);
            } else {
                // 4th request should be rate limited
                $response->assertStatus(429);
            }
        }
    }

    /**
     * Test password reset OTP verification fails without code.
     */
    public function test_password_reset_otp_verification_fails_without_code(): void
    {
        $response = $this->postJson('/api/v1/password/verify-otp', [
            'email' => 'test@example.com',
            'token' => 'abc123',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['code']);
    }

    /**
     * Test password reset validation requires new password.
     */
    public function test_password_reset_requires_new_password(): void
    {
        $response = $this->postJson('/api/v1/password/reset', [
            'email' => 'test@example.com',
            'token' => 'abc123',
            'code' => '123456',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['password']);
    }

    /**
     * Test authenticated user can update password.
     */
    public function test_authenticated_user_can_update_password(): void
    {
        $user = User::factory()->create([
            'phone_verified_at' => now(),
            'password' => bcrypt('oldpassword'),
        ]);

        $token = $user->token();

        $response = $this->withHeader('Authorization', 'Bearer '.$token)
            ->postJson('/api/v1/password/update', [
                'old_password' => 'oldpassword',
                'password' => 'newpassword123',
                'password_confirmation' => 'newpassword123',
            ]);

        $response->assertStatus(200);
    }

    /**
     * Test unauthenticated user cannot update password.
     */
    public function test_unauthenticated_user_cannot_update_password(): void
    {
        $response = $this->postJson('/api/v1/password/update', [
            'old_password' => 'oldpassword',
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ]);

        $response->assertStatus(401);
    }

    /**
     * Test password update fails with wrong old password.
     */
    public function test_password_update_fails_with_wrong_old_password(): void
    {
        $user = User::factory()->create([
            'phone_verified_at' => now(),
            'password' => bcrypt('correctpassword'),
        ]);

        $token = $user->token();

        $response = $this->withHeader('Authorization', 'Bearer '.$token)
            ->postJson('/api/v1/password/update', [
                'old_password' => 'wrongpassword',
                'password' => 'newpassword123',
                'password_confirmation' => 'newpassword123',
            ]);

        $response->assertStatus(400);
    }

    /**
     * Test password update requires confirmation.
     */
    public function test_password_update_requires_confirmation(): void
    {
        $user = User::factory()->create([
            'phone_verified_at' => now(),
            'password' => bcrypt('oldpassword'),
        ]);

        $token = $user->token();

        $response = $this->withHeader('Authorization', 'Bearer '.$token)
            ->postJson('/api/v1/password/update', [
                'old_password' => 'oldpassword',
                'password' => 'newpassword123',
            ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['password']);
    }
}
