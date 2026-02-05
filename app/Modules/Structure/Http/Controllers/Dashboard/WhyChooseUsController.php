<?php

namespace App\Modules\Structure\Http\Controllers\Dashboard;

use App\Modules\Structure\Http\Requests\Dashboard\WhyChooseUsRequest;

final class WhyChooseUsController extends StructureController
{
    protected string $contentKey = 'why_choose_us';

    protected array $locales = ['en', 'ar'];

    public function store(WhyChooseUsRequest $request)
    {
        return parent::_store($request);
    }
}
