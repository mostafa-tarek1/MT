<?php

namespace App\Modules\Structure\Http\Controllers\Api\V1;

use App\Modules\Structure\Http\Resources\V1\OurAdvantagesResource;

final class OurAdvantagesController extends ApiStructureController
{
    protected string $contentKey = 'our_advantages';

    protected $resource = OurAdvantagesResource::class;
}
