<?php

namespace App\Modules\Auth\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Http\Requests\StoreWindowRequest;
use App\Modules\Auth\Http\Requests\UpdateProfileRequest;
use App\Modules\Auth\Http\Requests\UpdateStoreLocationRequest;
use App\Modules\Auth\Http\Requests\UploadProfileImageRequest;
use App\Modules\Auth\Services\UserProfileService;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function __construct(
        protected UserProfileService $profileService
    ) {}

    /**
     * Get authenticated user's profile
     */
    public function getProfile(Request $request)
    {
        return $this->profileService->getProfile($request->user()->id);
    }

    /**
     * Update authenticated user's profile
     */
    public function updateProfile(UpdateProfileRequest $request)
    {
        return $this->profileService->updateProfile(
            $request->user()->id,
            $request->validated()
        );
    }

    /**
     * Upload profile image
     */
    public function uploadProfileImage(UploadProfileImageRequest $request)
    {
        return $this->profileService->uploadProfileImage(
            $request->user()->id,
            $request->file('image')
        );
    }

    /**
     * Upload background image
     */
    public function uploadBackgroundImage(UploadProfileImageRequest $request)
    {
        return $this->profileService->uploadBackgroundImage(
            $request->user()->id,
            $request->file('image')
        );
    }

    /**
     * Update store location
     */
    public function updateStoreLocation(UpdateStoreLocationRequest $request)
    {
        return $this->profileService->updateStoreLocation(
            $request->user()->id,
            $request->input('lat'),
            $request->input('lng')
        );
    }

    /**
     * Update additional phones
     */
    public function updateAdditionalPhones(Request $request)
    {
        $request->validate([
            'phones' => ['required', 'array', 'max:3'],
            'phones.*' => ['string', 'regex:/^[0-9]{9,15}$/'],
        ]);

        return $this->profileService->updateAdditionalPhones(
            $request->user()->id,
            $request->input('phones')
        );
    }

    /**
     * Update social links
     */
    public function updateSocialLinks(Request $request)
    {
        $request->validate([
            'links' => ['required', 'array'],
            'links.twitter' => ['sometimes', 'nullable', 'url'],
            'links.instagram' => ['sometimes', 'nullable', 'url'],
            'links.snapchat' => ['sometimes', 'nullable', 'url'],
            'links.facebook' => ['sometimes', 'nullable', 'url'],
            'links.tiktok' => ['sometimes', 'nullable', 'url'],
            'links.youtube' => ['sometimes', 'nullable', 'url'],
        ]);

        return $this->profileService->updateSocialLinks(
            $request->user()->id,
            $request->input('links')
        );
    }

    /**
     * Update tax number
     */
    public function updateTaxNumber(Request $request)
    {
        $request->validate([
            'tax_number' => ['required', 'string', 'max:50'],
        ]);

        return $this->profileService->updateTaxNumber(
            $request->user()->id,
            $request->input('tax_number')
        );
    }

    /**
     * Get store windows
     */
    public function getStoreWindows(Request $request)
    {
        $type = $request->query('type');

        return $this->profileService->getStoreWindows($request->user()->id, $type);
    }

    /**
     * Create or update store window
     */
    public function createOrUpdateStoreWindow(StoreWindowRequest $request)
    {
        return $this->profileService->createOrUpdateStoreWindow(
            $request->user()->id,
            $request->validated()
        );
    }

    /**
     * Delete store window
     */
    public function deleteStoreWindow(Request $request, int $windowId)
    {
        return $this->profileService->deleteStoreWindow(
            $request->user()->id,
            $windowId
        );
    }

    /**
     * Update store window order
     */
    public function updateStoreWindowOrder(Request $request)
    {
        $request->validate([
            'order' => ['required', 'array'],
            'order.*' => ['integer', 'exists:store_windows,id'],
        ]);

        return $this->profileService->updateStoreWindowOrder(
            $request->user()->id,
            $request->input('order')
        );
    }

    /**
     * Get public profile for any user
     */
    public function getPublicProfile(int $userId)
    {
        return $this->profileService->getProfile($userId);
    }
}
