<?php

namespace App\Modules\Structure\View\Components\Buttons;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CreateButton extends Component
{
    public string $route;

    public function __construct(string $route, string $text = 'dashboard.Create')
    {
        $this->route = $route;
    }

    public function render(): View|Closure|string
    {
        return view('structure::components.buttons.create-button');
    }
}
