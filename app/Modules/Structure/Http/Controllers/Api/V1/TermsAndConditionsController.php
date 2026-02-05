<?php

namespace App\Modules\Structure\Http\Controllers\Api\V1;

use App\Modules\Structure\Http\Resources\V1\TermsAndConditionsResource;

final class TermsAndConditionsController extends ApiStructureController
{
    protected string $contentKey = 'terms_and_conditions';

    protected $resource = TermsAndConditionsResource::class;
}
