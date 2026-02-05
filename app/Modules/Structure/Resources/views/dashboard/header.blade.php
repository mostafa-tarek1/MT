@extends('base::components.dashboard.layouts.master')
@section('title', __('dashboard.Header Section'))

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row"></div>
            <div class="content-body">
                <section class="users-list-wrapper">
                    <x-breadcrumb.breadcrumb title="{{ __('dashboard.Header Section') }}"
                        :breadcrumbs="[['name' => __('dashboard.Header Section')]]" />
                    <section id="column-selectors">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h4 class="card-title mb-0">{{ __('dashboard.Header Section') }}</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <x-form.form-component :route="route('header.store')" method="POST">
                                                <div class="row">
                                                    <x-input.input-field name="ar[brand_text]" id="ar_brand_text"
                                                        placeholder="{{ __('dashboard.Brand Text (AR)') }}"
                                                        label="{{ __('dashboard.Brand Text (AR)') }}"
                                                        :value="old('ar.brand_text') ?? ($content['ar']['brand_text'] ?? '')" />
                                                    <x-input.input-field name="en[brand_text]" id="en_brand_text"
                                                        placeholder="{{ __('dashboard.Brand Text (EN)') }}"
                                                        label="{{ __('dashboard.Brand Text (EN)') }}"
                                                        :value="old('en.brand_text') ?? ($content['en']['brand_text'] ?? '')" />
                                                </div>
                                                <div class="row">
                                                    <x-input.input-field name="ar[cta_text]" id="ar_cta_text"
                                                        placeholder="{{ __('dashboard.CTA Button Text (AR)') }}"
                                                        label="{{ __('dashboard.CTA Button Text (AR)') }}"
                                                        :value="old('ar.cta_text') ?? ($content['ar']['cta_text'] ?? '')" />
                                                    <x-input.input-field name="en[cta_text]" id="en_cta_text"
                                                        placeholder="{{ __('dashboard.CTA Button Text (EN)') }}"
                                                        label="{{ __('dashboard.CTA Button Text (EN)') }}"
                                                        :value="old('en.cta_text') ?? ($content['en']['cta_text'] ?? '')" />
                                                </div>

                                                <hr class="my-3 text-muted" />
                                                <h3 class="text-muted">@lang('dashboard.Navigation Items')</h3>
                                                <div id="nav-items-container" class="mb-4">
                                                    @foreach (old('ar.nav_items', data_get($content, 'ar.nav_items', [])) as $index => $item)
                                                        <div class="row nav-item-row mb-3" data-index="{{ $index }}">
                                                            <div class="col-12 col-md-4">
                                                                <x-input.input-field
                                                                    name="ar[nav_items][{{ $index }}][text]"
                                                                    id="ar_nav_text_{{ $index }}"
                                                                    placeholder="{{ __('dashboard.Item Text (AR)') }}"
                                                                    label="{{ __('dashboard.Item Text (AR)') }}"
                                                                    :value="old('ar.nav_items.' . $index . '.text', $item['text'] ?? '')" />
                                                            </div>
                                                            <div class="col-12 col-md-4">
                                                                <x-input.input-field
                                                                    name="en[nav_items][{{ $index }}][text]"
                                                                    id="en_nav_text_{{ $index }}"
                                                                    placeholder="{{ __('dashboard.Item Text (EN)') }}"
                                                                    label="{{ __('dashboard.Item Text (EN)') }}"
                                                                    :value="old('en.nav_items.' . $index . '.text', data_get($content, 'en.nav_items.' . $index . '.text', ''))" />
                                                            </div>
                                                            <div class="col-12 col-md-3">
                                                                <x-input.input-field
                                                                    name="ar[nav_items][{{ $index }}][href]"
                                                                    id="nav_href_{{ $index }}"
                                                                    placeholder="{{ __('dashboard.Item Link') }}"
                                                                    label="{{ __('dashboard.Item Link') }}"
                                                                    :value="old('ar.nav_items.' . $index . '.href', data_get($content, 'ar.nav_items.' . $index . '.href', ''))" />
                                                                <input type="hidden"
                                                                    name="en[nav_items][{{ $index }}][href]"
                                                                    value="{{ old('en.nav_items.' . $index . '.href', data_get($content, 'en.nav_items.' . $index . '.href', data_get($content, 'ar.nav_items.' . $index . '.href', ''))) }}">
                                                            </div>
                                                            <div class="col-12 col-md-1 d-flex align-items-center justify-content-center">
                                                                <button type="button" class="btn btn-sm btn-danger remove-nav-item"
                                                                    title="{{ __('dashboard.delete') }}">
                                                                    @lang('dashboard.delete')
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <button type="button" class="btn btn-success btn-sm mt-2" id="add_nav_item">
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
            let navIndex = {{ count(old('ar.nav_items', data_get($content, 'ar.nav_items', []))) }};

            $('#add_nav_item').on('click', function() {
                const row = `
                    <div class="row nav-item-row mb-3" data-index="${navIndex}">
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="ar_nav_text_${navIndex}">@lang('dashboard.Item Text (AR)')</label>
                                <input type="text" name="ar[nav_items][${navIndex}][text]" id="ar_nav_text_${navIndex}" class="form-control" placeholder="@lang('dashboard.Item Text (AR)')">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="en_nav_text_${navIndex}">@lang('dashboard.Item Text (EN)')</label>
                                <input type="text" name="en[nav_items][${navIndex}][text]" id="en_nav_text_${navIndex}" class="form-control" placeholder="@lang('dashboard.Item Text (EN)')">
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label class="form-label" for="nav_href_${navIndex}">@lang('dashboard.Item Link')</label>
                                <input type="text" name="ar[nav_items][${navIndex}][href]" id="nav_href_${navIndex}" class="form-control" placeholder="@lang('dashboard.Item Link')">
                                <input type="hidden" name="en[nav_items][${navIndex}][href]" value="">
                            </div>
                        </div>
                        <div class="col-12 col-md-1 d-flex align-items-center justify-content-center">
                            <button type="button" class="btn btn-sm btn-danger remove-nav-item" title="@lang('dashboard.delete')">
                                @lang('dashboard.delete')
                            </button>
                        </div>
                    </div>`;
                $('#nav-items-container').append(row);
                navIndex++;
            });

            $(document).on('click', '.remove-nav-item', function(e) {
                e.preventDefault();
                $(this).closest('.nav-item-row').remove();
            });
        });
    </script>
@endpush
