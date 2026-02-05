<?php

namespace App\Modules\Structure\Http\Controllers\Dashboard;

use App\Modules\Structure\Http\Requests\Dashboard\CustomerReviewRequest;

final class CustomerReviewController extends StructureController
{
    protected string $contentKey = 'customer_reviews';

    protected array $locales = ['en', 'ar'];

    public function store(CustomerReviewRequest $request)
    {
        return parent::_store($request);
    }
}
