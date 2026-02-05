<?php

namespace App\Modules\Structure\Http\Controllers\Dashboard;

use App\Modules\Structure\Http\Requests\Dashboard\StatsRequest;

final class StatsController extends StructureController
{
    protected string $contentKey = 'stats';

    protected array $locales = ['en', 'ar'];

    public function store(StatsRequest $request)
    {
        return parent::_store($request);
    }
}
