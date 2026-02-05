<?php

namespace App\Modules\Auth\Http\Controllers\Api\V1\Profile;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Http\Requests\Api\V1\Profile\DeleteProfileImageRequest;
use App\Modules\Auth\Http\Requests\Api\V1\Profile\UpdateProfileImageRequest;
use App\Modules\Auth\Http\Resources\V1\User\UserResource;
use App\Modules\Auth\Http\Services\Api\V1\Profile\ProfileImageService;
use Illuminate\Http\JsonResponse;

class ProfileImageController extends Controller
{
    public function __construct(private readonly ProfileImageService $profileImageService) {}

    /**
     * Upload or update user profile image
     */
    public function update(UpdateProfileImageRequest $request): JsonResponse
    {
        try {
            $user = auth()->user();

            $this->profileImageService->updateProfileImage(
                $user,
                $request->file('profile_image')
            );

            return response()->json([
                'message' => __('messages.profile_image_updated_successfully'),
                'data' => new UserResource($user->fresh(), false),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => __('messages.Something went wrong'),
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Delete user profile image
     */
    public function delete(DeleteProfileImageRequest $request): JsonResponse
    {
        try {
            $user = auth()->user();

            $deleted = $this->profileImageService->deleteProfileImage($user);

            if (! $deleted) {
                return response()->json([
                    'message' => __('messages.no_profile_image_found'),
                ], 404);
            }

            return response()->json([
                'message' => __('messages.profile_image_deleted_successfully'),
                'data' => new UserResource($user->fresh(), false),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => __('messages.Something went wrong'),
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
