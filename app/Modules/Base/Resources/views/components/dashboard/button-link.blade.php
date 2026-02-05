@props([
    'href' => '#',
    'variant' => 'primary', // primary, secondary, success, danger, warning, info, light, dark
    'size' => 'md', // sm, md, lg
    'icon' => null,
    'iconPosition' => 'left', // left, right
    'outline' => false,
    'disabled' => false,
    'block' => false,
    'target' => '_self',
])

@php
    $classes = 'btn rounded-pill shadow-sm d-inline-flex align-items-center justify-content-center gap-1';

    // Variant
    if ($outline) {
        $classes .= ' btn-outline-' . $variant;
    } else {
        $classes .= ' btn-' . $variant;
    }

    // Size classes + spacing rules
    $sizeMap = [
        'sm' => [
            'class' => 'btn-sm',
            'style' => 'min-height:32px;padding:0.35rem 0.85rem;font-size:0.85rem;gap:0.35rem;',
        ],
        'md' => ['class' => '', 'style' => 'min-height:40px;padding:0.55rem 1.25rem;font-size:1rem;gap:0.45rem;'],
        'lg' => ['class' => 'btn-lg', 'style' => 'min-height:48px;padding:0.75rem 1.5rem;font-size:1.1rem;gap:0.6rem;'],
    ];
    $sizeKey = is_string($size) ? $size : 'md';
    $sizeClass = $sizeMap[$sizeKey] ?? ['class' => '', 'style' => ''];

    $classes .= ' ' . $sizeClass['class'];
    $styleAttr = $sizeClass['style'];

    // Icon normalization (allows "plus" shortcut)
    $iconClass = null;
    if ($icon) {
        $iconClass = \Illuminate\Support\Str::contains($icon, ' ') ? $icon : 'feather icon-' . $icon;
    }

    // Block
    if ($block) {
        $classes .= ' btn-block';
    }

    // Disabled
    if ($disabled) {
        $classes .= ' disabled';
    }
@endphp

<a href="{{ $disabled ? 'javascript:void(0)' : $href }}" {{ $attributes->merge(['class' => trim($classes)]) }}
    @if ($disabled) aria-disabled="true" tabindex="-1" @endif
    @if ($target !== '_self') target="{{ $target }}" @endif
    @if ($styleAttr) style="{{ $styleAttr }}" @endif>
    @if ($iconClass && $iconPosition === 'left')
        <i class="{{ $iconClass }}"></i>
    @endif

    {{ $slot }}

    @if ($iconClass && $iconPosition === 'right')
        <i class="{{ $iconClass }}"></i>
    @endif
</a>
