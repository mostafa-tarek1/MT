<?php

namespace App\Modules\Structure\Http\Controllers\Dashboard;

use App\Modules\Structure\Http\Requests\Dashboard\QuoteModalRequest;

final class QuoteModalController extends StructureController
{
    protected string $contentKey = 'quote_modal';

    protected array $locales = ['en', 'ar'];

    public function store(QuoteModalRequest $request)
    {
        return parent::_store($request);
    }
}
