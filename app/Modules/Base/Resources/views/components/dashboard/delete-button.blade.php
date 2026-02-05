@props([
    'modalId' => null,
    'itemName' => '',
    'itemNameEn' => null,
    'deleteRoute' => '#',
    'warningMessage' => null,
    'hasChildren' => false,
    'childrenCount' => 0,
    'size' => 'sm', // sm, md, lg
])

@php
    $modalId = $modalId ?? 'deleteModal' . uniqid();

    $classes = 'btn btn-danger rounded-pill shadow-sm d-inline-flex align-items-center justify-content-center';

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
    $style = $sizeClass['style'];
@endphp

{{-- Delete Button --}}
<button type="button" {{ $attributes->merge(['class' => $classes]) }} data-toggle="modal"
    data-target="#{{ $modalId }}" title="{{ __('dashboard.delete') }}"
    @if ($style) style="{{ $style }}" @endif>
    <i class="feather icon-trash"></i>
</button>

{{-- Delete Modal --}}
<div class="modal fade" id="{{ $modalId }}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white">
                    <i class="feather icon-alert-triangle mr-1"></i>
                    {{ __('dashboard.confirm_delete') }}
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form action="{{ $deleteRoute }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <i class="feather icon-alert-circle text-warning" style="font-size: 60px;"></i>
                    </div>
                    <h4 class="text-center mb-3">{{ __('dashboard.delete_warning') }}</h4>
                    <p class="text-center mb-2">
                        {{ $warningMessage ?? __('dashboard.delete_confirmation') }}
                    </p>
                    <div class="alert alert-light border text-center">
                        <strong>{{ $itemName }}</strong>
                        @if ($itemNameEn)
                            <br><small class="text-muted">{{ $itemNameEn }}</small>
                        @endif
                    </div>
                    @if ($hasChildren && $childrenCount > 0)
                        <div class="alert alert-warning">
                            <i class="feather icon-alert-triangle mr-1"></i>
                            {{ __('dashboard.has_children_warning', ['count' => $childrenCount]) }}
                        </div>
                    @endif

                    {{ $slot }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="feather icon-x mr-1"></i>
                        {{ __('dashboard.cancel') }}
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <i class="feather icon-trash-2 mr-1"></i>
                        {{ __('dashboard.delete') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
