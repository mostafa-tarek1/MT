<?php

declare(strict_types=1);

namespace App\Modules\Structure\View\Components\Input;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class ImageInput extends Component
{
    public function __construct(
        public $name,
        public $fileId,
        public $label = '',
        public $value = '',
        public $id = '',
        public $wrapperClass = 'col-md-12 mb-3',
        public $previewClass = 'col-md-2',
        public $showPreview = true,
        public $previewMaxHeight = '200px',
        public $accept = 'image/*',
        public $required = false,
        public $gallery = null,
        public $enName = null,
        public $arName = null
    ) {
        if (empty($this->id)) {
            $this->id = 'image_'.$this->fileId;
        }
        // If custom names not provided, use default pattern
        if ($this->enName === null) {
            $this->enName = 'en['.$this->name.']';
        }
        if ($this->arName === null) {
            $this->arName = 'ar['.$this->name.']';
        }
    }

    public function render(): View|Closure|string
    {
        return view('structure::components.input.image-input');
    }
}
