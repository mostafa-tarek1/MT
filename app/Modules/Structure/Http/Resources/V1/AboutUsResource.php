<?php

namespace App\Modules\Structure\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AboutUsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'section_title' => $this->main_title,
            'title_1' => $this->title1,
            'description_1' => $this->desc1,
            'statistics' => $this->statistics,
            'title_2' => $this->title2,
            'description_2' => $this->desc2,
        ];
    }
}
