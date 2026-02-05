<?php

namespace App\Modules\Base\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Base\Http\Traits\Responser;

class BaseController extends Controller
{
    use Responser;

    /**
     * Default pagination per page
     */
    protected int $perPage = 15;

    /**
     * Get per page from request or use default
     */
    protected function getPerPage(): int
    {
        return request()->input('per_page', $this->perPage);
    }
}
