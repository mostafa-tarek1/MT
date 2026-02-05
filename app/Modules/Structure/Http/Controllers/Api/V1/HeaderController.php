<?php

namespace App\Modules\Structure\Http\Controllers\Api\V1;

use App\Modules\Structure\Http\Resources\V1\HeaderResource;

final class HeaderController extends ApiStructureController
{
    protected string $contentKey = 'header';

    protected $resource = HeaderResource::class;
}
