<?php

namespace App\Modules\Structure\Http\Controllers\Api\V1;

use App\Modules\Structure\Http\Resources\V1\MobileSectionResource;

final class MobileSectionController extends ApiStructureController
{
    protected string $contentKey = 'mobile_section';

    protected $resource = MobileSectionResource::class;
}
