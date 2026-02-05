<?php

namespace App\Modules\Auth\Repository;

use Illuminate\Support\Collection;

interface UserProfileRepositoryInterface
{
    /**
     * Update user profile information
     */
    public function updateProfile(int $userId, array $data): array;

    /**
     * Upload profile image
     */
    public function uploadProfileImage(int $userId, $file): string;

    /**
     * Upload background image
     */
    public function uploadBackgroundImage(int $userId, $file): string;

    /**
     * Update store location
     */
    public function updateStoreLocation(int $userId, float $lat, float $lng): array;

    /**
     * Update additional phones
     */
    public function updateAdditionalPhones(int $userId, array $phones): array;

    /**
     * Update social links
     */
    public function updateSocialLinks(int $userId, array $links): array;

    /**
     * Update tax number
     */
    public function updateTaxNumber(int $userId, string $taxNumber): string;

    /**
     * Get user profile with store windows
     */
    public function getProfileWithStoreWindows(int $userId): \App\Modules\Auth\Models\User;

    /**
     * Create or update store window
     */
    public function createOrUpdateStoreWindow(int $userId, array $data): array;

    /**
     * Get store windows for user
     */
    public function getStoreWindows(int $userId, ?string $type = null): Collection;

    /**
     * Delete store window
     */
    public function deleteStoreWindow(int $userId, int $windowId): bool;

    /**
     * Update store window order
     */
    public function updateStoreWindowOrder(int $userId, array $orderedIds): bool;
}
