<?php

namespace Tests\Feature\Auth;

use App\Modules\Auth\Models\Otp;
use App\Modules\Auth\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OtpTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test OTP is generated when user signs up.
     */
    public function test_otp_is_generated_on_sign_up(): void
    {
        $response = $this->postJson('/api/v1/auth/sign-up', [
            'name' => 'Ahmed Mohamed',
            'phone' => '01012345678',
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('otps', [
            'phone' => '01012345678',
        ]);

        $otp = Otp::where('phone', '01012345678')->first();
        $this->assertNotNull($otp);
        $this->assertNotNull($otp->code);
        $this->assertNotNull($otp->token);
    }

    /**
     * Test user can send OTP via phone endpoint.
     */
    public function test_user_can_send_otp_via_phone_endpoint(): void
    {
        $user = User::factory()->create([
            'phone' => '01012345678',
        ]);

        $response = $this->postJson('/api/v1/phone/send-otp', [
            'phone' => '01012345678',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'otp_token',
                ],
            ]);

        $this->assertDatabaseHas('otps', [
            'phone' => '01012345678',
        ]);
    }

    /**
     * Test OTP send endpoint is rate limited.
     */
    public function test_otp_send_is_rate_limited(): void
    {
        User::factory()->create(['phone' => '01012345678']);

        // Make 4 requests (limit is 3 per minute)
        for ($i = 0; $i < 4; $i++) {
            $response = $this->postJson('/api/v1/phone/send-otp', [
                'phone' => '01012345678',
            ]);

            if ($i < 3) {
                // First 3 should succeed
                $this->assertContains($response->status(), [200, 400]);
            } else {
                // 4th request should be rate limited
                $response->assertStatus(429);
            }
        }
    }

    /**
     * Test authenticated user can send OTP.
     */
    public function test_authenticated_user_can_send_otp(): void
    {
        $user = User::factory()->create([
            'phone_verified_at' => now(),
        ]);

        $token = $user->token();

        $response = $this->withHeader('Authorization', 'Bearer '.$token)
            ->postJson('/api/v1/otp/send');

        $response->assertStatus(200);

        $this->assertDatabaseHas('otps', [
            'user_id' => $user->id,
        ]);
    }

    /**
     * Test unauthenticated user cannot send OTP to protected endpoint.
     */
    public function test_unauthenticated_user_cannot_send_otp(): void
    {
        $response = $this->postJson('/api/v1/otp/send');

        $response->assertStatus(401);
    }

    /**
     * Test OTP validation fails with invalid phone format.
     */
    public function test_otp_validation_fails_with_invalid_phone(): void
    {
        $response = $this->postJson('/api/v1/phone/send-otp', [
            'phone' => '123',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['phone']);
    }

    /**
     * Test verify OTP fails without code.
     */
    public function test_verify_otp_fails_without_code(): void
    {
        $response = $this->postJson('/api/v1/phone/verify-otp', [
            'phone' => '01012345678',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['code']);
    }

    /**
     * Test verify OTP is rate limited.
     */
    public function test_verify_otp_is_rate_limited(): void
    {
        User::factory()->create(['phone' => '01012345678']);

        // Make 4 requests (limit is 3 per minute)
        for ($i = 0; $i < 4; $i++) {
            $response = $this->postJson('/api/v1/phone/verify-otp', [
                'phone' => '01012345678',
                'code' => '123456',
            ]);

            if ($i < 3) {
                // First 3 should fail with validation or bad request
                $this->assertContains($response->status(), [400, 404, 422]);
            } else {
                // 4th request should be rate limited
                $response->assertStatus(429);
            }
        }
    }

    /**
     * Test resend OTP is rate limited.
     */
    public function test_resend_otp_is_rate_limited(): void
    {
        User::factory()->create(['phone' => '01012345678']);

        // Make 4 requests (limit is 3 per minute)
        for ($i = 0; $i < 4; $i++) {
            $response = $this->postJson('/api/v1/phone/resend-otp', [
                'phone' => '01012345678',
            ]);

            if ($i < 3) {
                $this->assertContains($response->status(), [200, 400]);
            } else {
                $response->assertStatus(429);
            }
        }
    }
}
