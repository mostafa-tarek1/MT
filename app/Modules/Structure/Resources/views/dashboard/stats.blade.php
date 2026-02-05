@extends('base::components.dashboard.layouts.master')
@section('title', __('dashboard.Stats Section'))

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row"></div>
            <div class="content-body">
                <section class="users-list-wrapper">
                    <x-breadcrumb.breadcrumb title="{{ __('dashboard.Stats Section') }}" :breadcrumbs="[['name' => __('dashboard.Stats Section')]]" />
                    <section id="column-selectors">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h4 class="card-title mb-0">{{ __('dashboard.Stats Section') }}</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <x-form.form-component :route="route('stats.store')" method="POST">
                                                <div class="row">
                                                    <x-input.input-field name="ar[title]" id="ar_title"
                                                        placeholder="{{ __('dashboard.Title (AR)') }}"
                                                        label="{{ __('dashboard.Title (AR)') }}" :value="old('ar.title') ?? ($content['ar']['title'] ?? '')" />
                                                    <x-input.input-field name="en[title]" id="en_title"
                                                        placeholder="{{ __('dashboard.Title (EN)') }}"
                                                        label="{{ __('dashboard.Title (EN)') }}" :value="old('en.title') ?? ($content['en']['title'] ?? '')" />
                                                </div>
                                                <div class="row">
                                                    <x-input.input-field name="ar[subtitle]" id="ar_subtitle"
                                                        placeholder="{{ __('dashboard.Subtitle (AR)') }}"
                                                        label="{{ __('dashboard.Subtitle (AR)') }}" :value="old('ar.subtitle') ??
                                                            ($content['ar']['subtitle'] ?? '')" />
                                                    <x-input.input-field name="en[subtitle]" id="en_subtitle"
                                                        placeholder="{{ __('dashboard.Subtitle (EN)') }}"
                                                        label="{{ __('dashboard.Subtitle (EN)') }}" :value="old('en.subtitle') ??
                                                            ($content['en']['subtitle'] ?? '')" />
                                                </div>

                                                <hr class="my-3 text-muted" />
                                                <h3 class="text-muted">@lang('dashboard.Stats Items')</h3>
                                                <div id="stats-items-container" class="mb-4">
                                                    @foreach (old('ar.items', data_get($content, 'ar.items', [])) as $index => $item)
                                                        <div class="row stat-item-row mb-3"
                                                            data-index="{{ $index }}">
                                                            <div class="col-12 col-md-4">
                                                                <x-input.input-field
                                                                    name="ar[items][{{ $index }}][label]"
                                                                    id="ar_item_label_{{ $index }}"
                                                                    placeholder="{{ __('dashboard.Item Label (AR)') }}"
                                                                    label="{{ __('dashboard.Item Label (AR)') }}"
                                                                    :value="old(
                                                                        'ar.items.' . $index . '.label',
                                                                        $item['label'] ?? '',
                                                                    )" />
                                                            </div>
                                                            <div class="col-12 col-md-4">
                                                                <x-input.input-field
                                                                    name="en[items][{{ $index }}][label]"
                                                                    id="en_item_label_{{ $index }}"
                                                                    placeholder="{{ __('dashboard.Item Label (EN)') }}"
                                                                    label="{{ __('dashboard.Item Label (EN)') }}"
                                                                    :value="old(
                                                                        'en.items.' . $index . '.label',
                                                                        data_get(
                                                                            $content,
                                                                            'en.items.' . $index . '.label',
                                                                            '',
                                                                        ),
                                                                    )" />
                                                            </div>
                                                            <div class="col-12 col-md-3">
                                                                <x-input.input-field
                                                                    name="ar[items][{{ $index }}][value]"
                                                                    id="stat_value_{{ $index }}"
                                                                    placeholder="{{ __('dashboard.Item Value') }}"
                                                                    label="{{ __('dashboard.Item Value') }}"
                                                                    :value="old(
                                                                        'ar.items.' . $index . '.value',
                                                                        data_get(
                                                                            $content,
                                                                            'ar.items.' . $index . '.value',
                                                                            '',
                                                                        ),
                                                                    )" />
                                                                <input type="hidden"
                                                                    name="en[items][{{ $index }}][value]"
                                                                    value="{{ old('en.items.' . $index . '.value', data_get($content, 'en.items.' . $index . '.value', data_get($content, 'ar.items.' . $index . '.value', ''))) }}">
                                                            </div>
                                                            <div
                                                                class="col-12 col-md-1 d-flex align-items-center justify-content-center">
                                                                <button type="button"
                                                                    class="btn btn-sm btn-danger remove-stat-item"
                                                                    title="{{ __('dashboard.delete') }}">
                                                                    @lang('dashboard.delete')
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <button type="button" class="btn btn-success btn-sm mt-2"
                                                    id="add_stat_item">
                                                    @lang('dashboard.add')
                                                </button>
                                            </x-form.form-component>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </section>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            let statIndex = {{ count(old('ar.items', data_get($content, 'ar.items', []))) }};

            $('#add_stat_item').on('click', function() {
                const row = `
                    <div class="row stat-item-row mb-3" data-index="${statIndex}">
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="ar_item_label_${statIndex}">@lang('dashboard.Item Label (AR)')</label>
                                <input type="text" name="ar[items][${statIndex}][label]" id="ar_item_label_${statIndex}" class="form-control" placeholder="@lang('dashboard.Item Label (AR)')">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="en_item_label_${statIndex}">@lang('dashboard.Item Label (EN)')</label>
                                <input type="text" name="en[items][${statIndex}][label]" id="en_item_label_${statIndex}" class="form-control" placeholder="@lang('dashboard.Item Label (EN)')">
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label class="form-label" for="stat_value_${statIndex}">@lang('dashboard.Item Value')</label>
                                <input type="text" name="ar[items][${statIndex}][value]" id="stat_value_${statIndex}" class="form-control" placeholder="@lang('dashboard.Item Value')">
                                <input type="hidden" name="en[items][${statIndex}][value]" value="">
                            </div>
                        </div>
                        <div class="col-12 col-md-1 d-flex align-items-center justify-content-center">
                            <button type="button" class="btn btn-sm btn-danger remove-stat-item" title="@lang('dashboard.delete')">
                                @lang('dashboard.delete')
                            </button>
                        </div>
                    </div>`;
                $('#stats-items-container').append(row);
                statIndex++;
            });

            $(document).on('click', '.remove-stat-item', function(e) {
                e.preventDefault();
                $(this).closest('.stat-item-row').remove();
            });
        });
    </script>
@endpush
