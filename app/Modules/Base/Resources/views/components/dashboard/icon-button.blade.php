@props([
    'icon' => 'feather icon-help-circle',
    'type' => 'button',
    'variant' => 'primary', // primary, secondary, success, danger, warning, info, light, dark
    'size' => 'sm', // sm, md, lg - default sm for table actions
    'outline' => false,
    'disabled' => false,
    'tooltip' => null,
])

@php
    $classes = 'btn rounded-pill shadow-sm d-inline-flex align-items-center justify-content-center';

    // Variant
    if ($outline) {
        $classes .= ' btn-outline-' . $variant;
    } else {
        $classes .= ' btn-' . $variant;
    }

    // Size & sizing styles
    $sizeMap = [
        'sm' => [
            'class' => 'btn-sm',
            'style' => 'width:34px;height:34px;padding:0.2rem;font-size:0.9rem;line-height:1;',
        ],
        'md' => ['class' => '', 'style' => 'width:40px;height:40px;padding:0.3rem;font-size:1rem;line-height:1;'],
        'lg' => [
            'class' => 'btn-lg',
            'style' => 'width:48px;height:48px;padding:0.4rem;font-size:1.1rem;line-height:1;',
        ],
    ];
    $sizeKey = is_string($size) ? $size : 'sm';
    $sizeClass = $sizeMap[$sizeKey] ?? $sizeMap['sm'];

    $classes .= ' ' . $sizeClass['class'];
    $styleAttr = $sizeClass['style'];

    // Disabled
    if ($disabled) {
        $classes .= ' disabled';
    }

    $iconClass = \Illuminate\Support\Str::contains($icon, ' ') ? $icon : 'feather icon-' . $icon;
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => trim($classes)]) }}
    @if ($disabled) disabled @endif
    @if ($tooltip) title="{{ $tooltip }}" data-toggle="tooltip" @endif
    @if ($styleAttr) style="{{ $styleAttr }}" @endif>
    <i class="{{ $iconClass }}"></i>
</button>
