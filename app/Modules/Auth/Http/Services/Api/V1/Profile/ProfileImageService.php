<?php

namespace App\Modules\Auth\Http\Services\Api\V1\Profile;

use App\Modules\Auth\Models\User;
use App\Modules\Base\Http\Traits\FileTrait;
use Illuminate\Support\Facades\File;

class ProfileImageService
{
    use FileTrait;

    /**
     * Upload or update user profile image
     *
     * @param  \Illuminate\Http\UploadedFile  $image
     */
    public function updateProfileImage(User $user, $image): string
    {
        // Upload new image and delete old one if exists
        $imagePath = $this->image($image, 'profiles/users/images', $user->profile_image);

        // Update user profile image
        $user->update([
            'profile_image' => $imagePath,
        ]);

        return $imagePath;
    }

    /**
     * Delete user profile image
     */
    public function deleteProfileImage(User $user): bool
    {
        if (! $user->profile_image) {
            return false;
        }

        // Delete the image file
        $imagePath = storage_path('app/public/'.$user->profile_image);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        // Update user to remove profile image
        $user->update([
            'profile_image' => null,
        ]);

        return true;
    }
}
