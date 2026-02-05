<?php

namespace App\Modules\Auth\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreWindowResource extends JsonResource
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
            'user_id' => $this->user_id,
            'window_type' => $this->window_type,
            'title' => [
                'ar' => $this->title_ar,
                'en' => $this->title_en,
            ],
            'content' => [
                'ar' => $this->content_ar,
                'en' => $this->content_en,
            ],
            'images' => $this->images ?? [],
            'order' => $this->order,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
