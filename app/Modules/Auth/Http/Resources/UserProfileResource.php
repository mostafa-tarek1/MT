<?php

namespace App\Modules\Auth\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'profile_image' => $this->profile_image,
            'profile_image_url' => $this->profile_image_url,
            'background_image' => $this->background_image,
            'background_image_url' => $this->background_image_url,
            'bio' => [
                'ar' => $this->bio_ar,
                'en' => $this->bio_en,
            ],
            'store_location' => [
                'lat' => $this->store_location_lat,
                'lng' => $this->store_location_lng,
            ],
            'additional_phones' => $this->additional_phones ?? [],
            'social_links' => $this->social_links ?? [],
            'external_links' => $this->external_links ?? [],
            'tax_number' => $this->tax_number,
            'phone_verified_at' => $this->phone_verified_at,
            'email_verified_at' => $this->email_verified_at,
            'otp_verified' => $this->otp_verified,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            // Include store windows if loaded
            'store_windows' => StoreWindowResource::collection($this->whenLoaded('storeWindows')),
        ];
    }
}
