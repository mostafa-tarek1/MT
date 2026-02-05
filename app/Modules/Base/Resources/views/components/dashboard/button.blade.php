@props([
    'type' => 'button',
    'variant' => 'primary', // primary, secondary, success, danger, warning, info, light, dark
    'size' => 'md', // sm, md, lg
    'icon' => null,
    'iconPosition' => 'left', // left, right
    'outline' => false,
    'disabled' => false,
    'block' => false,
    'loading' => false,
])

@php
    $classes = 'btn rounded-pill shadow-sm d-inline-flex align-items-center justify-content-center';

    // Variant
    if ($outline) {
        $classes .= ' btn-outline-' . $variant;
    } else {
        $classes .= ' btn-' . $variant;
    }

    // Size mapping for consistent height/padding
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

    // Icon normalization for shorthand names
    $iconClass = null;
    if ($icon) {
        $iconClass = \Illuminate\Support\Str::contains($icon, ' ') ? $icon : 'feather icon-' . $icon;
    }

    // Block
    if ($block) {
        $classes .= ' btn-block w-100';
    }

    // Disabled
    if ($disabled || $loading) {
        $classes .= ' disabled';
    }
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => trim($classes)]) }}
    @if ($disabled || $loading) disabled @endif
    @if ($styleAttr) style="{{ $styleAttr }}" @endif>
    @if ($loading)
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
    @endif

    @if ($iconClass && $iconPosition === 'left' && !$loading)
        <i class="{{ $iconClass }}"></i>
    @endif

    {{ $slot }}

    @if ($iconClass && $iconPosition === 'right' && !$loading)
        <i class="{{ $iconClass }}"></i>
    @endif
</button>
