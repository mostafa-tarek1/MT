<?php

namespace App\Modules\Structure\Http\Controllers\Api\V1;

use App\Modules\Structure\Http\Resources\V1\FooterResource;

final class FooterController extends ApiStructureController
{
    protected string $contentKey = 'footer';

    protected $resource = FooterResource::class;
}
