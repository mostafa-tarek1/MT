<?php

namespace App\Modules\Structure\Http\Controllers\Dashboard;

use App\Modules\Structure\Http\Requests\Dashboard\FeaturesRequest;

final class FeaturesController extends StructureController
{
    protected string $contentKey = 'features';

    protected array $locales = ['en', 'ar'];

    public function store(FeaturesRequest $request)
    {
        return parent::_store($request);
    }
}

