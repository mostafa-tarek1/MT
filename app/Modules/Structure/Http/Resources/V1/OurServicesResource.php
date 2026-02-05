<?php

namespace App\Modules\Structure\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OurServicesResource extends JsonResource
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
            'title' => $this->title1,
            'description' => $this->desc1,
        ];
    }
}
