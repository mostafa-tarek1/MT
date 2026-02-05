<?php

namespace App\Modules\Structure\Http\Controllers\Api\V1;

use App\Modules\Structure\Http\Resources\V1\StructureServiceResource;

final class StructureServiceController extends ApiStructureController
{
    protected string $contentKey = 'structure_service';

    protected $resource = StructureServiceResource::class;
}
