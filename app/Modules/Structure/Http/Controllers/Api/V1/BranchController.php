<?php

namespace App\Modules\Structure\Http\Controllers\Api\V1;

use App\Modules\Structure\Http\Resources\V1\BranchResource;

final class BranchController extends ApiStructureController
{
    protected string $contentKey = 'struct_branches';

    protected $resource = BranchResource::class;
}
