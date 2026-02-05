<?php

namespace App\Modules\Structure\Http\Controllers\Api\V1;

use App\Modules\Structure\Http\Resources\V1\PrivacyPolicyResource;

final class PrivacyPolicyController extends ApiStructureController
{
    protected string $contentKey = 'privacy_policy';

    protected $resource = PrivacyPolicyResource::class;
}
