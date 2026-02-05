<?php

namespace App\Modules\Structure\Http\Controllers\Api\V1;

use App\Modules\Structure\Http\Resources\V1\AboutUsResource;

final class AboutUsController extends ApiStructureController
{
    protected string $contentKey = 'about';

    protected $resource = AboutUsResource::class;
}
