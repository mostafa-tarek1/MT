<?php

namespace App\Modules\Auth\Http\Resources\V1\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function __construct($resource, private readonly bool $withToken)
    {
        parent::__construct($resource);
    }

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
            'background_image_url' => $this->whenNotNull($this->background_image_url),
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
            'otp_token' => $this->whenNotNull($this->otp?->token),
            'otp_verified' => $this->whenNotNull($this->otp_verified),
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'token' => $this->when($this->withToken, $this->token()),

            // Include store windows if loaded
            'store_windows' => $this->when(
                $this->relationLoaded('storeWindows'),
                function () {
                    return $this->storeWindows->map(function ($window) {
                        return [
                            'id' => $window->id,
                            'window_type' => $window->window_type,
                            'title' => [
                                'ar' => $window->title_ar,
                                'en' => $window->title_en,
                            ],
                            'content' => [
                                'ar' => $window->content_ar,
                                'en' => $window->content_en,
                            ],
                            'images' => $window->images ?? [],
                            'order' => $window->order,
                            'is_active' => $window->is_active,
                        ];
                    });
                }
            ),
        ];
    }
}
