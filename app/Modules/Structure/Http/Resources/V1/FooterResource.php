<?php

namespace App\Modules\Structure\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FooterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'site_logo' => $this->help_photo1,
            'description' => $this->desc1,
            'location' => $this->title,
            'contact' => [
                'phone' => $this->phone,
                'email' => $this->email,
            ],
            'social_links' => $this->social,
        ];
    }
}
