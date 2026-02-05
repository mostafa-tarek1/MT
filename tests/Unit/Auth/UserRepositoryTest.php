<?php

namespace Tests\Unit\Auth;

use App\Modules\Auth\Models\User;
use App\Modules\Auth\Repository\Eloquent\UserRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private UserRepository $userRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userRepository = new UserRepository(new User);
    }

    /**
     * Test can find user by phone.
     */
    public function test_can_find_user_by_phone(): void
    {
        $user = User::factory()->create([
            'phone' => '01012345678',
        ]);

        $foundUser = $this->userRepository->findByPhone('01012345678');

        $this->assertNotNull($foundUser);
        $this->assertEquals($user->id, $foundUser->id);
        $this->assertEquals('01012345678', $foundUser->phone);
    }

    /**
     * Test returns null when user not found by phone.
     */
    public function test_returns_null_when_user_not_found_by_phone(): void
    {
        $foundUser = $this->userRepository->findByPhone('09999999999');

        $this->assertNull($foundUser);
    }

    /**
     * Test can find user by email.
     */
    public function test_can_find_user_by_email(): void
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
        ]);

        $foundUser = $this->userRepository->findByEmail('test@example.com');

        $this->assertNotNull($foundUser);
        $this->assertEquals($user->id, $foundUser->id);
        $this->assertEquals('test@example.com', $foundUser->email);
    }

    /**
     * Test can create user.
     */
    public function test_can_create_user(): void
    {
        $userData = [
            'name' => 'Ahmed Mohamed',
            'phone' => '01012345678',
            'email' => 'ahmed@example.com',
        ];

        $user = $this->userRepository->create($userData);

        $this->assertNotNull($user);
        $this->assertEquals('Ahmed Mohamed', $user->name);
        $this->assertEquals('01012345678', $user->phone);
        $this->assertDatabaseHas('users', [
            'phone' => '01012345678',
            'name' => 'Ahmed Mohamed',
        ]);
    }

    /**
     * Test can update user.
     */
    public function test_can_update_user(): void
    {
        $user = User::factory()->create([
            'name' => 'Old Name',
        ]);

        $updated = $this->userRepository->update($user->id, [
            'name' => 'New Name',
        ]);

        $this->assertTrue($updated);
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'New Name',
        ]);
    }

    /**
     * Test can delete user.
     */
    public function test_can_delete_user(): void
    {
        $user = User::factory()->create();

        $deleted = $this->userRepository->delete($user->id);

        $this->assertTrue($deleted);
        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);
    }

    /**
     * Test can get all users.
     */
    public function test_can_get_all_users(): void
    {
        User::factory()->count(5)->create();

        $users = $this->userRepository->getAll();

        $this->assertCount(5, $users);
    }

    /**
     * Test can paginate users.
     */
    public function test_can_paginate_users(): void
    {
        User::factory()->count(25)->create();

        $paginatedUsers = $this->userRepository->paginate(10);

        $this->assertEquals(10, $paginatedUsers->count());
        $this->assertEquals(25, $paginatedUsers->total());
        $this->assertEquals(3, $paginatedUsers->lastPage());
    }
}
