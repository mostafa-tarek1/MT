<?php

namespace App\Modules\Structure\Http\Controllers\Api\V1;

use App\Modules\Structure\Http\Resources\V1\OurServicesResource;

final class OurServicesController extends ApiStructureController
{
    protected string $contentKey = 'our_services';

    protected $resource = OurServicesResource::class;
}
