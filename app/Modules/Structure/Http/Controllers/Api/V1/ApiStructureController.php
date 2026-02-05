<?php

namespace App\Modules\Structure\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Modules\Structure\Http\Services\Api\V1\StructureService;

class ApiStructureController extends Controller
{
    protected StructureService $structure;

    protected string $contentKey = '';

    protected array $with = [];

    protected array $append = [null, null];

    protected $resource = null;

    public function __construct(
        StructureService $structureService,
    ) {
        $this->structure = $structureService;
    }

    public function __invoke()
    {
        return $this->structure->get($this->contentKey, $this->resource, $this->with);
    }
}
