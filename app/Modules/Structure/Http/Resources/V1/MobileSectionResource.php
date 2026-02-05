<?php

namespace App\Modules\Structure\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MobileSectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'title' => $this->main_title,
            'description' => $this->desc1,
            'features' => $this->features,
            'image' => $this->image,
            'android_link' => $this->android_link,
            'ios_link' => $this->ios_link,

        ];
    }
}
