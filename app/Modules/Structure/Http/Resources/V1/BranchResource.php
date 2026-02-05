<?php

namespace App\Modules\Structure\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BranchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'main_title' => $this->main_title,
            'desc' => $this->desc1,
            'image' => $this->image,

        ];
    }
}
