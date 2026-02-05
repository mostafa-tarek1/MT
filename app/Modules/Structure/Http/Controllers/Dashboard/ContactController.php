<?php

namespace App\Modules\Structure\Http\Controllers\Dashboard;

use App\Modules\Structure\Http\Requests\Dashboard\ContactRequest;

final class ContactController extends StructureController
{
    protected string $contentKey = 'contact';

    protected array $locales = ['en', 'ar'];

    public function store(ContactRequest $request)
    {
        return parent::_store($request);
    }
}

