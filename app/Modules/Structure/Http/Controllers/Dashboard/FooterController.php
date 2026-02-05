<?php

namespace App\Modules\Structure\Http\Controllers\Dashboard;

use App\Modules\Structure\Http\Requests\Dashboard\FooterRequest;

final class FooterController extends StructureController
{
    protected string $contentKey = 'footer';

    protected array $locales = ['en', 'ar'];

    public function store(FooterRequest $request)
    {
        return parent::_store($request);
    }
}
