<?php

namespace App\Modules\Base\View\Components\Dashboard\Layouts;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Breadcrumb extends Component
{
    public string $now;

    public function __construct(string $now = '')
    {
        $this->now = $now;
    }

    public function render(): View
    {
        return view('base::components.dashboard.layouts.breadcrumb');
    }
}
