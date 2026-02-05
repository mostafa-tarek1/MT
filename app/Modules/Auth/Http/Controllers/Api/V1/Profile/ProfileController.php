<?php

namespace App\Modules\Auth\Http\Controllers\Api\V1\Profile;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Http\Requests\Api\V1\Profile\UpdateProfileImageRequest;
use App\Modules\Auth\Http\Requests\Api\V1\Profile\UpdateProfileRequest;
use App\Modules\Auth\Http\Services\Api\V1\Profile\ProfileService;
use Illuminate\Http\Request;

/**
 * @group Profile Management
 *
 * APIs for managing user profile including profile image and profile information
 */
class ProfileController extends Controller
{
    public function __construct(
        private readonly ProfileService $profileService,
    ) {}

    /**
     * Get Profile
     *
     * Get the authenticated user's profile information.
     *
     * @authenticated
     *
     * @response 200 {
     *   "status": 200,
     *   "message": "تم جلب البيانات بنجاح",
     *   "data": {
     *     "id": 1,
     *     "name": "Ahmed Mohamed",
     *     "phone": "01012345678",
     *     "profile_image_url": "http://127.0.0.1:8000/storage/profiles/users/images/1234567890_123456.jpg",
     *     "status": "active"
     *   }
     * }
     */
    public function getProfile(Request $request)
    {
        return $this->profileService->getProfile($request);
    }

    /**
     * Update Profile
     *
     * Update the authenticated user's profile information (name, phone, and/or profile image).
     *
     * @authenticated
     *
     * @bodyParam name string optional The user's full name. Example: Ahmed Mohamed
     * @bodyParam phone string optional The user's phone number (11 digits). Example: 01012345678
     * @bodyParam profile_image file optional The profile image file (jpeg, jpg, png, gif, max 2MB).
     *
     * @response 200 {
     *   "status": 200,
     *   "message": "تم تحديث الملف الشخصي بنجاح",
     *   "data": {
     *     "id": 1,
     *     "name": "Ahmed Mohamed Updated",
     *     "phone": "01012345678",
     *     "profile_image_url": "http://127.0.0.1:8000/storage/profiles/users/images/1234567890_123456.jpg",
     *     "status": "active"
     *   }
     * }
     */
    public function updateProfile(UpdateProfileRequest $request)
    {
        return $this->profileService->updateProfile($request);
    }

    /**
     * Upload Profile Image
     *
     * Upload or update the authenticated user's profile image.
     *
     * @authenticated
     *
     * @bodyParam profile_image file required The profile image file (jpeg, jpg, png, gif, max 2MB).
     *
     * @response 200 {
     *   "status": 200,
     *   "message": "تم تحديث صورة الملف الشخصي بنجاح",
     *   "data": {
     *     "profile_image_url": "http://127.0.0.1:8000/storage/profiles/users/images/1234567890_123456.jpg"
     *   }
     * }
     */
    public function uploadProfileImage(UpdateProfileImageRequest $request)
    {
        return $this->profileService->uploadProfileImage($request);
    }

    /**
     * Delete Profile Image
     *
     * Delete the authenticated user's profile image.
     *
     * @authenticated
     *
     * @response 200 {
     *   "status": 200,
     *   "message": "تم حذف صورة الملف الشخصي بنجاح",
     *   "data": null
     * }
     */
    public function deleteProfileImage(Request $request)
    {
        return $this->profileService->deleteProfileImage($request);
    }
}
