<?php

namespace App\Modules\Structure\Http\Controllers\Dashboard;

use App\Modules\Structure\Http\Requests\Dashboard\HeaderRequest;

final class HeaderController extends StructureController
{
    protected string $contentKey = 'header';

    protected array $locales = ['en', 'ar'];

    public function store(HeaderRequest $request)
    {
        return parent::_store($request);
    }
}
