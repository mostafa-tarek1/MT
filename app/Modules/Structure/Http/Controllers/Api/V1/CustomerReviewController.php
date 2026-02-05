<?php

namespace App\Modules\Structure\Http\Controllers\Api\V1;

use App\Modules\Structure\Http\Resources\V1\CustomerReviewResource;

final class CustomerReviewController extends ApiStructureController
{
    protected string $contentKey = 'customer_reviews';

    protected $resource = CustomerReviewResource::class;
}
