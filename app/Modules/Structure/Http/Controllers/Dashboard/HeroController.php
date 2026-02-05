<?php

namespace App\Modules\Structure\Http\Controllers\Dashboard;

use App\Modules\Structure\Http\Requests\Dashboard\HeroRequest;

final class HeroController extends StructureController
{
    protected string $contentKey = 'hero';

    protected array $locales = ['en', 'ar'];

    public function store(HeroRequest $request)
    {
        return parent::_store($request);
    }
}
