<?php

namespace App\Modules\Auth\Repository\Eloquent;

use App\Modules\Auth\Models\StoreWindow;
use App\Modules\Auth\Models\User;
use App\Modules\Auth\Repository\UserProfileRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserProfileRepository implements UserProfileRepositoryInterface
{
    /**
     * Update user profile information
     */
    public function updateProfile(int $userId, array $data): array
    {
        $user = User::findOrFail($userId);

        $allowedFields = [
            'name',
            'email',
            'bio_ar',
            'bio_en',
            'external_links',
        ];

        $updateData = array_intersect_key($data, array_flip($allowedFields));

        $user->update($updateData);

        return $user->fresh()->toArray();
    }

    /**
     * Upload profile image
     */
    public function uploadProfileImage(int $userId, $file): string
    {
        $user = User::findOrFail($userId);

        // Delete old image if exists
        if ($user->profile_image) {
            Storage::disk('public')->delete($user->profile_image);
        }

        // Store new image
        $path = $file->store('profiles', 'public');

        $user->update(['profile_image' => $path]);

        return $path;
    }

    /**
     * Upload background image
     */
    public function uploadBackgroundImage(int $userId, $file): string
    {
        $user = User::findOrFail($userId);

        // Delete old image if exists
        if ($user->background_image) {
            Storage::disk('public')->delete($user->background_image);
        }

        // Store new image
        $path = $file->store('backgrounds', 'public');

        $user->update(['background_image' => $path]);

        return $path;
    }

    /**
     * Update store location
     */
    public function updateStoreLocation(int $userId, float $lat, float $lng): array
    {
        $user = User::findOrFail($userId);
        $user->update([
            'store_location_lat' => $lat,
            'store_location_lng' => $lng,
        ]);

        return [
            'lat' => $lat,
            'lng' => $lng,
        ];
    }

    /**
     * Update additional phones
     */
    public function updateAdditionalPhones(int $userId, array $phones): array
    {
        $user = User::findOrFail($userId);
        $user->update([
            'additional_phones' => $phones,
        ]);

        return $phones;
    }

    /**
     * Update social links
     */
    public function updateSocialLinks(int $userId, array $links): array
    {
        $user = User::findOrFail($userId);
        $user->update([
            'social_links' => $links,
        ]);

        return $links;
    }

    /**
     * Update tax number
     */
    public function updateTaxNumber(int $userId, string $taxNumber): string
    {
        $user = User::findOrFail($userId);
        $user->update([
            'tax_number' => $taxNumber,
        ]);

        return $taxNumber;
    }

    /**
     * Get user profile with store windows
     */
    public function getProfileWithStoreWindows(int $userId): User
    {
        $user = User::with([
            'storeWindows' => function ($query) {
                $query->active()->ordered();
            },
        ])->findOrFail($userId);

        return $user;
    }

    /**
     * Create or update store window
     */
    public function createOrUpdateStoreWindow(int $userId, array $data): array
    {
        $data['user_id'] = $userId;

        if (isset($data['id'])) {
            // Try to find existing window
            $window = StoreWindow::where('user_id', $userId)
                ->where('id', $data['id'])
                ->first();

            if ($window) {
                // Update existing window
                $window->update($data);

                return $window->fresh()->toArray();
            }

            // If window not found, remove id and create new one
            unset($data['id']);
        }

        // Check if user has less than 5 windows when creating new
        $windowsCount = StoreWindow::where('user_id', $userId)->count();

        if ($windowsCount >= 5) {
            throw new \Exception('Maximum 5 store windows allowed');
        }

        // Create new window
        $window = StoreWindow::create($data);

        return $window->toArray();
    }

    /**
     * Get store windows for user
     */
    public function getStoreWindows(int $userId, ?string $type = null): Collection
    {
        $query = StoreWindow::where('user_id', $userId)->active()->ordered();

        if ($type) {
            $query->ofType($type);
        }

        return $query->get();
    }

    /**
     * Delete store window
     */
    public function deleteStoreWindow(int $userId, int $windowId): bool
    {
        return StoreWindow::where('user_id', $userId)
            ->where('id', $windowId)
            ->delete();
    }

    /**
     * Update store window order
     */
    public function updateStoreWindowOrder(int $userId, array $orderedIds): bool
    {
        DB::beginTransaction();

        try {
            foreach ($orderedIds as $order => $id) {
                StoreWindow::where('user_id', $userId)
                    ->where('id', $id)
                    ->update(['order' => $order]);
            }

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();

            return false;
        }
    }
}
