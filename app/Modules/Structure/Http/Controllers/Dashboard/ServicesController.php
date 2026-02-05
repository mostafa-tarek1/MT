<?php

namespace App\Modules\Structure\Http\Controllers\Dashboard;

use App\Modules\Structure\Http\Requests\Dashboard\ServicesRequest;

final class ServicesController extends StructureController
{
    protected string $contentKey = 'services';

    protected array $locales = ['en', 'ar'];

    public function store(ServicesRequest $request)
    {
        return parent::_store($request);
    }
}
