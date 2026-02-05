<?php

namespace App\Modules\Auth\Services;

use App\Modules\Auth\Repository\UserProfileRepositoryInterface;
use App\Modules\Base\Http\Traits\Responser;
use Illuminate\Support\Facades\Log;

class UserProfileService
{
    use Responser;

    public function __construct(
        protected UserProfileRepositoryInterface $profileRepository
    ) {}

    /**
     * Get user profile with all details
     */
    public function getProfile(int $userId)
    {
        try {
            $user = $this->profileRepository->getProfileWithStoreWindows($userId);
            $profile = new \App\Modules\Auth\Http\Resources\UserProfileResource($user);

            return $this->responseSuccess(200, 'Profile retrieved successfully', $profile);
        } catch (\Exception $e) {
            Log::error('Error in UserProfileService@getProfile: '.$e->getMessage());

            return $this->responseFail(500, 'Failed to retrieve profile');
        }
    }

    /**
     * Update user profile
     */
    public function updateProfile(int $userId, array $data)
    {
        try {
            $profile = $this->profileRepository->updateProfile($userId, $data);

            return $this->responseSuccess(200, 'Profile updated successfully', $profile);
        } catch (\Exception $e) {
            Log::error('Error in UserProfileService@updateProfile: '.$e->getMessage());

            return $this->responseFail(500, 'Failed to update profile');
        }
    }

    /**
     * Upload profile image
     */
    public function uploadProfileImage(int $userId, $file)
    {
        try {
            $path = $this->profileRepository->uploadProfileImage($userId, $file);

            return $this->responseSuccess(200, 'Profile image uploaded successfully', [
                'path' => $path,
                'url' => asset('storage/'.$path),
            ]);
        } catch (\Exception $e) {
            Log::error('Error in UserProfileService@uploadProfileImage: '.$e->getMessage());

            return $this->responseFail(500, 'Failed to upload profile image');
        }
    }

    /**
     * Upload background image
     */
    public function uploadBackgroundImage(int $userId, $file)
    {
        try {
            $path = $this->profileRepository->uploadBackgroundImage($userId, $file);

            return $this->responseSuccess(200, 'Background image uploaded successfully', [
                'path' => $path,
                'url' => asset('storage/'.$path),
            ]);
        } catch (\Exception $e) {
            Log::error('Error in UserProfileService@uploadBackgroundImage: '.$e->getMessage());

            return $this->responseFail(500, 'Failed to upload background image');
        }
    }

    /**
     * Update store location
     */
    public function updateStoreLocation(int $userId, float $lat, float $lng)
    {
        try {
            $location = $this->profileRepository->updateStoreLocation($userId, $lat, $lng);

            return $this->responseSuccess(200, 'Store location updated successfully', $location);
        } catch (\Exception $e) {
            Log::error('Error in UserProfileService@updateStoreLocation: '.$e->getMessage());

            return $this->responseFail(500, 'Failed to update store location');
        }
    }

    /**
     * Update additional phones
     */
    public function updateAdditionalPhones(int $userId, array $phones)
    {
        try {
            $phonesData = $this->profileRepository->updateAdditionalPhones($userId, $phones);

            return $this->responseSuccess(200, 'Additional phones updated successfully', $phonesData);
        } catch (\Exception $e) {
            Log::error('Error in UserProfileService@updateAdditionalPhones: '.$e->getMessage());

            return $this->responseFail(500, 'Failed to update additional phones');
        }
    }

    /**
     * Update social links
     */
    public function updateSocialLinks(int $userId, array $links)
    {
        try {
            $linksData = $this->profileRepository->updateSocialLinks($userId, $links);

            return $this->responseSuccess(200, 'Social links updated successfully', $linksData);
        } catch (\Exception $e) {
            Log::error('Error in UserProfileService@updateSocialLinks: '.$e->getMessage());

            return $this->responseFail(500, 'Failed to update social links');
        }
    }

    /**
     * Update tax number
     */
    public function updateTaxNumber(int $userId, string $taxNumber)
    {
        try {
            $taxData = $this->profileRepository->updateTaxNumber($userId, $taxNumber);

            return $this->responseSuccess(200, 'Tax number updated successfully', ['tax_number' => $taxData]);
        } catch (\Exception $e) {
            Log::error('Error in UserProfileService@updateTaxNumber: '.$e->getMessage());

            return $this->responseFail(500, 'Failed to update tax number');
        }
    }

    /**
     * Get store windows
     */
    public function getStoreWindows(int $userId, ?string $type = null)
    {
        try {
            $windows = $this->profileRepository->getStoreWindows($userId, $type);

            return $this->responseSuccess(200, 'Store windows retrieved successfully', $windows);
        } catch (\Exception $e) {
            Log::error('Error in UserProfileService@getStoreWindows: '.$e->getMessage());

            return $this->responseFail(500, 'Failed to retrieve store windows');
        }
    }

    /**
     * Create or update store window
     */
    public function createOrUpdateStoreWindow(int $userId, array $data)
    {
        try {
            $window = $this->profileRepository->createOrUpdateStoreWindow($userId, $data);

            return $this->responseSuccess(200, 'Store window saved successfully', $window);
        } catch (\Exception $e) {
            Log::error('Error in UserProfileService@createOrUpdateStoreWindow: '.$e->getMessage());

            return $this->responseFail(500, $e->getMessage());
        }
    }

    /**
     * Delete store window
     */
    public function deleteStoreWindow(int $userId, int $windowId)
    {
        try {
            $deleted = $this->profileRepository->deleteStoreWindow($userId, $windowId);

            if (! $deleted) {
                return $this->responseFail(404, 'Store window not found');
            }

            return $this->responseSuccess(200, 'Store window deleted successfully');
        } catch (\Exception $e) {
            Log::error('Error in UserProfileService@deleteStoreWindow: '.$e->getMessage());

            return $this->responseFail(500, 'Failed to delete store window');
        }
    }

    /**
     * Update store window order
     */
    public function updateStoreWindowOrder(int $userId, array $orderedIds)
    {
        try {
            $this->profileRepository->updateStoreWindowOrder($userId, $orderedIds);

            return $this->responseSuccess(200, 'Store window order updated successfully');
        } catch (\Exception $e) {
            Log::error('Error in UserProfileService@updateStoreWindowOrder: '.$e->getMessage());

            return $this->responseFail(500, 'Failed to update store window order');
        }
    }
}
