<?php

namespace App\Modules\Auth\Http\Services\Api\V1\Profile;

use App\Modules\Auth\Http\Requests\Api\V1\Profile\UpdateProfileImageRequest;
use App\Modules\Auth\Http\Requests\Api\V1\Profile\UpdateProfileRequest;
use App\Modules\Auth\Http\Resources\V1\User\UserResource;
use App\Modules\Auth\Repository\UserRepositoryInterface;
use App\Modules\Base\Http\Helpers\Http;

use function App\Modules\Base\Http\Helpers\responseFail;
use function App\Modules\Base\Http\Helpers\responseSuccess;

use App\Modules\Base\Http\Traits\FileTrait;
use App\Modules\Base\Services\PlatformService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProfileService extends PlatformService
{
    use FileTrait;

    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
    ) {}

    /**
     * Get authenticated user profile
     */
    public function getProfile(Request $request)
    {
        try {
            $user = $request->user()->load([
                'storeWindows' => function ($query) {
                    $query->where('is_active', true)->orderBy('order');
                },
            ]);

            return responseSuccess(Http::OK, __('messages.Data retrieved successfully'), new UserResource($user, false));
        } catch (Exception $e) {
            Log::error('Get Profile Error: '.$e->getMessage());

            return responseFail(Http::BAD_REQUEST, __('messages.Something went wrong'));
        }
    }

    /**
     * Update user profile (name, phone, and/or profile image)
     */
    public function updateProfile(UpdateProfileRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = $request->user();
            $data = $request->validated();

            $updateData = [];

            // Update name if provided
            if (isset($data['name'])) {
                $updateData['name'] = $data['name'];
            }

            // Update phone if provided
            if (isset($data['phone'])) {
                // Check if phone is different from current phone
                if ($data['phone'] !== $user->phone) {
                    $updateData['phone'] = $data['phone'];
                    // Reset phone verification when phone is changed
                    $updateData['phone_verified_at'] = null;
                }
            }

            // Handle profile image upload
            if ($request->hasFile('profile_image')) {
                $updateData['profile_image'] = $this->image(
                    $request->file('profile_image'),
                    'profiles/users/images',
                    $user->profile_image
                );
            }

            // Update user if there's any data to update
            if (! empty($updateData)) {
                $user->update($updateData);
            }

            DB::commit();

            return responseSuccess(Http::OK, __('messages.Profile updated successfully'), new UserResource($user->fresh(), false));
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Update Profile Error: '.$e->getMessage());
            Log::error('Stack trace: '.$e->getTraceAsString());

            return responseFail(Http::BAD_REQUEST, __('messages.Something went wrong'));
        }
    }

    /**
     * Upload or update profile image
     */
    public function uploadProfileImage(UpdateProfileImageRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = $request->user();

            // Upload new profile image
            $profileImagePath = $this->image(
                $request->file('profile_image'),
                'profiles/users/images',
                $user->profile_image
            );

            // Update user profile image
            $user->update([
                'profile_image' => $profileImagePath,
            ]);

            DB::commit();

            return responseSuccess(Http::OK, __('messages.Profile image updated successfully'), [
                'profile_image_url' => $user->fresh()->profile_image_url,
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Upload Profile Image Error: '.$e->getMessage());

            return responseFail(Http::BAD_REQUEST, __('messages.Something went wrong'));
        }
    }

    /**
     * Delete profile image
     */
    public function deleteProfileImage(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = $request->user();

            if ($user->profile_image) {
                // Delete the old image file
                $this->deleteFile($user->profile_image);

                // Update user to remove profile image
                $user->update([
                    'profile_image' => null,
                ]);
            }

            DB::commit();

            return responseSuccess(Http::OK, __('messages.Profile image deleted successfully'));
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Delete Profile Image Error: '.$e->getMessage());

            return responseFail(Http::BAD_REQUEST, __('messages.Something went wrong'));
        }
    }

    public function whatIsMyPlatform(): string
    {
        return 'platform: api';
    }

    public static function platform(): string
    {
        return 'api';
    }
}
