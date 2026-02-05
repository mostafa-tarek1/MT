<?php

namespace App\Modules\Structure\Http\Controllers\Dashboard;

use App\Modules\Structure\Http\Requests\Dashboard\FlexibleSystemRequest;

final class FlexibleSystemController extends StructureController
{
    protected string $contentKey = 'flexible_system';

    protected array $locales = ['en', 'ar'];

    public function store(FlexibleSystemRequest $request)
    {
        return parent::_store($request);
    }
}

