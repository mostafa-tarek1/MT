<?php

namespace App\Modules\Base\Http\Traits;

use Illuminate\Http\UploadedFile;

trait FileManager
{
    use FileTrait;

    protected function upload(UploadedFile|string|null $file, string $folder): ?string
    {
        $uploadedFile = $file;

        if (is_string($file) && request()->hasFile($file)) {
            $uploadedFile = request()->file($file);
        }

        if (! $uploadedFile instanceof UploadedFile) {
            return null;
        }

        return $uploadedFile->store($folder, 'public');
    }
}
