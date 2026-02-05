<?php

namespace App\Modules\Base\Http\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait FileTrait
{
    /**
     * Upload an image file
     *
     * @param  mixed  $image  The uploaded image file
     * @param  string  $folder  Folder to store the image
     * @param  string|null  $oldImage  Path to old image to delete
     * @return string Path to the stored image
     */
    final public function image(mixed $image, string $folder, ?string $oldImage = null): string
    {
        // delete old image
        if ($oldImage && Storage::disk('public')->exists($oldImage)) {
            Storage::disk('public')->delete($oldImage);
        }
        $rand = rand(999999, 1000000);
        $imageName = time().'_'.$rand.'.'.$image->getClientOriginalExtension();
        $image->move(storage_path('app/public/'.$folder), $imageName);

        return $folder.'/'.$imageName;
    }

    /**
     * Upload multiple image files
     *
     * @param  array  $images  Array of uploaded image files
     * @param  string  $folder  Folder to store the images
     * @param  array|null  $oldImages  Paths to old images to delete
     * @return array Array of paths to stored images
     */
    final public function uploadMultiImages(array $images, string $folder, ?array $oldImages = null): array
    {
        // delete oldImages if exists
        if ($oldImages) {
            foreach ($oldImages as $oldImage) {
                if (Storage::disk('public')->exists($oldImage)) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
        }
        $files = [];
        foreach ($images as $image) {
            $rand = rand(999999, 1000000);
            $imageName = time().'_'.$rand.'.'.$image->getClientOriginalExtension();
            $image->move(storage_path('app/public/'.$folder), $imageName);
            $files[] = $folder.'/'.$imageName;
        }

        return $files;
    }

    /**
     * Convert base64 string to image and store it
     *
     * @param  string  $base64Image  Base64 encoded image string
     * @param  string  $folder  Folder to store the image
     * @param  string|null  $oldImage  Path to old image to delete
     * @return string Path to the stored image
     */
    final public function base64Image(string $base64Image, string $folder, ?string $oldImage = null): string
    {
        $this->deleteFile($oldImage);
        preg_match('/^data:image\/(\w+);base64,/', $base64Image, $matches);
        $extension = $matches[1]; // Get the extension (e.g., png, jpg)
        $base64Data = substr($base64Image, strpos($base64Image, ',') + 1);
        $imageData = base64_decode($base64Data);
        $rand = rand(999999, 1000000);
        $filename = 'image_'.$rand.'.'.$extension;
        $filePath = $folder.'/'.$filename;
        Storage::put('public/'.$filePath, $imageData);

        return $filePath;
    }

    /**
     * Delete a file from storage
     *
     * @param  string|null  $oldImage  Path to file to delete
     */
    final public function deleteFile(?string $oldImage = null): void
    {
        if ($oldImage && Storage::disk('public')->exists($oldImage)) {
            Storage::disk('public')->delete($oldImage);
        }
    }

    /**
     * Delete multiple files from storage
     *
     * @param  array|null  $oldFiles  Array of file paths to delete
     */
    final public function deleteMulti(?array $oldFiles = null): void
    {
        // delete oldImages if exists
        if ($oldFiles) {
            foreach ($oldFiles as $oldImage) {
                if (Storage::disk('public')->exists($oldImage)) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
        }
    }
}
