<?php

namespace App\Modules\Structure\Http\Controllers\Dashboard;

use App\Modules\Structure\Http\Requests\Dashboard\CTARequest;

final class CTAController extends StructureController
{
    protected string $contentKey = 'cta';

    protected array $locales = ['en', 'ar'];

    public function store(CTARequest $request)
    {
        return parent::_store($request);
    }
}

