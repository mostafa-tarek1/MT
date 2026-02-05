<?php

namespace App\Modules\Structure\View\Components\Input;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MultiSelect extends Component
{
    public string $name;

    public string $id;

    public ?string $label;

    public array $options;

    public array $selected;

    public string $placeholder;

    public string $noResults;

    public string $dir;

    public ?string $wrapperClass;

    public string $class;

    public bool $required;

    public bool $disabled;

    public bool $readonly;

    public function __construct(
        string $name,
        array $value = [],
        ?string $id = null,
        ?string $label = null,
        iterable $options = [],
        array $selected = [],
        ?string $placeholder = null,
        ?string $noResults = null,
        ?string $dir = null,
        string $wrapperClass = 'col-md-12 mb-3',
        string $class = '',
        bool $required = false,
        bool $disabled = false,
        bool $readonly = false,
        string|Closure $optionValue = 'id',
        string|Closure $optionLabel = 'name',
    ) {
        $this->name = $name;
        $this->id = $id ?? 'multi_select_'.uniqid();
        $this->label = $label;
        $this->options = $this->convertToArray($options, $optionValue, $optionLabel);
        $this->selected = $selected;
        $this->placeholder = $placeholder ?? __('Press to select');
        $this->noResults = $noResults ?? __('No results found');
        $this->dir = $dir ?? (app()->getLocale() === 'ar' ? 'rtl' : 'ltr');
        $this->wrapperClass = $wrapperClass;
        $this->class = $class;
        $this->required = $required;
        $this->disabled = $disabled;
        $this->readonly = $readonly;
        $this->selected = ! empty($value) ? $value : $selected;
    }

    protected function convertToArray(iterable $collection, string|Closure $valueField, string|Closure $labelField): array
    {
        $array = [];

        foreach ($collection as $item) {
            $value = is_callable($valueField) ? $valueField($item) : $item->{$valueField};
            $label = is_callable($labelField) ? $labelField($item) : $item->{$labelField};
            $array[$value] = $label;
        }

        return $array;
    }

    public function render(): View
    {
        return view('structure::components.input.multi-select');
    }
}
