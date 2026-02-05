<?php

namespace App\Modules\Structure\Http\Controllers\Dashboard;

use App\Modules\Structure\Http\Requests\Dashboard\WhoIsThisForRequest;

final class WhoIsThisForController extends StructureController
{
    protected string $contentKey = 'who_is_this_for';

    protected array $locales = ['en', 'ar'];

    public function store(WhoIsThisForRequest $request)
    {
        return parent::_store($request);
    }
}

