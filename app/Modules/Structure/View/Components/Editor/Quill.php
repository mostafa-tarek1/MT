<?php

namespace App\Modules\Structure\View\Components\Editor;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Quill extends Component
{
    public $id;

    public $label;

    public $name;

    public $value;

    public function __construct($id = 'quill', $label = 'note', $name = 'content', $value = '')
    {
        $this->id = $id;
        $this->label = $label;
        $this->name = $name;
        $this->value = $value;
    }

    public function render(): View|Closure|string
    {
        return view('structure::components.editor.quill');
    }
}
