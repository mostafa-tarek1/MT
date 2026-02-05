@section('css_addons')
    <link rel="stylesheet" href="{{ asset('assets/libs/choices.js/public/assets/styles/choices.min.css') }}">
    <style>
        [dir="rtl"] .choices__inner {
            text-align: right;
        }

        [dir="rtl"] .choices__list--dropdown,
        [dir="rtl"] .choices__list--multiple {
            text-align: right;
        }
    </style>
@endsection

<div class="{{ $wrapperClass }}">
    @if ($label)
        <label class="form-label" for="{{ $id }}">{{ $label }}</label>
    @endif

    <select id="{{ $id }}" name="{{ $name }}[]" class="form-select {{ $class }}" multiple
        dir="{{ $dir }}" {{ $required ? 'required' : '' }} {{ $disabled ? 'disabled' : '' }}
        {{ $readonly ? 'readonly' : '' }}>
        @foreach ($options as $key => $value)
            <option value="{{ $key }}" {{ in_array($key, old($name, $selected)) ? 'selected' : '' }}>
                {{ $value }}
            </option>
        @endforeach
    </select>

    @error($name)
        <div class="text-danger p-2">{{ $message }}</div>
    @enderror
</div>


@push('scripts')
    <!-- Include Choices JS -->
    <script src="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/scripts/choices.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const element = document.getElementById(@json($id));
            const direction = document.documentElement.getAttribute('dir') || 'ltr';

            if (element) {
                new Choices(element, {
                    silent: false,
                    removeItems: true,
                    removeItemButton: true,
                    searchEnabled: true,
                    searchChoices: true,
                    shouldSort: false,
                    placeholder: true,
                    placeholderValue: @json($placeholder ?? 'اختر من القائمة'),
                    loadingText: 'جاري التحميل...',
                    noResultsText: 'لا توجد نتائج مطابقة',
                    noChoicesText: 'لا توجد خيارات للاختيار منها',
                    itemSelectText: 'اضغط للتحديد',
                    uniqueItemText: 'يمكنك فقط إضافة قيم فريدة',
                    customAddItemText: 'يمكنك فقط إضافة القيم المطابقة للشروط',
                    addItemText: (value) => `اضغط Enter لإضافة "<b>${value}</b>"`,
                    removeItemIcon: true,
                    removeItemIconText: 'إزالة العنصر',
                    maxItemText: (maxItemCount) => `يمكنك فقط إضافة ${maxItemCount} عناصر`,
                    classNames: {
                        containerOuter: 'choices',
                        containerInner: direction === 'rtl' ? 'choices__inner text-end' : 'choices__inner',
                        input: direction === 'rtl' ? 'choices__input text-end' : 'choices__input',
                        list: direction === 'rtl' ? 'choices__list text-end' : 'choices__list',
                        listDropdown: 'choices__list--dropdown',
                        item: 'choices__item',
                        itemSelectable: 'choices__item--selectable',
                        itemDisabled: 'choices__item--disabled',
                        itemChoice: 'choices__item--choice',
                        placeholder: 'choices__placeholder',
                        button: 'choices__button',
                        activeState: 'is-active',
                        focusState: 'is-focused',
                        openState: 'is-open',
                        disabledState: 'is-disabled',
                        highlightedState: 'is-highlighted',
                        selectedState: 'is-selected',
                        flippedState: 'is-flipped',
                        loadingState: 'is-loading',
                        noResults: 'has-no-results',
                        noChoices: 'has-no-choices'
                    },
                    position: 'auto',
                    searchFields: ['label', 'value'],
                    searchResultLimit: 5,
                    searchFloor: 1,
                    paste: true,
                    duplicateItemsAllowed: false,
                    delimiter: ',',
                    valueComparer: (a, b) => a === b,
                    renderSelectedChoices: 'auto',
                });
            }
        });
    </script>
@endpush
