@extends('base::components.dashboard.layouts.master')
@section('title', __('dashboard.Footer Section'))

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row"></div>
            <div class="content-body">
                <section class="users-list-wrapper">
                    <x-breadcrumb.breadcrumb title="{{ __('dashboard.Footer Section') }}"
                        :breadcrumbs="[['name' => __('dashboard.Footer Section')]]" />
                    <section id="column-selectors">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h4 class="card-title mb-0">{{ __('dashboard.Footer Section') }}</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <x-form.form-component :route="route('footer.store')" method="POST">
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
                                                    <x-editor.quill id="ar_description"
                                                        label="{{ __('dashboard.Description (AR)') }}" name="ar[description]"
                                                        :value="old('ar.description') ?? ($content['ar']['description'] ?? '')" />
                                                    <x-editor.quill id="en_description"
                                                        label="{{ __('dashboard.Description (EN)') }}" name="en[description]"
                                                        :value="old('en.description') ?? ($content['en']['description'] ?? '')" />
                                                </div>

                                                <hr class="my-3 text-muted" />
                                                <h3 class="text-muted">@lang('dashboard.Quick Links')</h3>
                                                <div id="quick-links-container" class="mb-4">
                                                    @foreach (old('ar.quick_links', data_get($content, 'ar.quick_links', [])) as $index => $item)
                                                        <div class="row quick-link-row mb-3" data-index="{{ $index }}">
                                                            <div class="col-12 col-md-4">
                                                                <x-input.input-field
                                                                    name="ar[quick_links][{{ $index }}][text]"
                                                                    id="ar_quick_text_{{ $index }}"
                                                                    placeholder="{{ __('dashboard.Item Text (AR)') }}"
                                                                    label="{{ __('dashboard.Item Text (AR)') }}"
                                                                    :value="old('ar.quick_links.' . $index . '.text', $item['text'] ?? '')" />
                                                            </div>
                                                            <div class="col-12 col-md-4">
                                                                <x-input.input-field
                                                                    name="en[quick_links][{{ $index }}][text]"
                                                                    id="en_quick_text_{{ $index }}"
                                                                    placeholder="{{ __('dashboard.Item Text (EN)') }}"
                                                                    label="{{ __('dashboard.Item Text (EN)') }}"
                                                                    :value="old('en.quick_links.' . $index . '.text', data_get($content, 'en.quick_links.' . $index . '.text', ''))" />
                                                            </div>
                                                            <div class="col-12 col-md-3">
                                                                <x-input.input-field
                                                                    name="ar[quick_links][{{ $index }}][href]"
                                                                    id="quick_href_{{ $index }}"
                                                                    placeholder="{{ __('dashboard.Item Link') }}"
                                                                    label="{{ __('dashboard.Item Link') }}"
                                                                    :value="old('ar.quick_links.' . $index . '.href', data_get($content, 'ar.quick_links.' . $index . '.href', ''))" />
                                                                <input type="hidden"
                                                                    name="en[quick_links][{{ $index }}][href]"
                                                                    value="{{ old('en.quick_links.' . $index . '.href', data_get($content, 'en.quick_links.' . $index . '.href', data_get($content, 'ar.quick_links.' . $index . '.href', ''))) }}">
                                                            </div>
                                                            <div class="col-12 col-md-1 d-flex align-items-center justify-content-center">
                                                                <button type="button" class="btn btn-sm btn-danger remove-quick-link"
                                                                    title="{{ __('dashboard.delete') }}">
                                                                    @lang('dashboard.delete')
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <button type="button" class="btn btn-success btn-sm mt-2" id="add_quick_link">
                                                    @lang('dashboard.add')
                                                </button>

                                                <hr class="my-3 text-muted" />
                                                <h3 class="text-muted">@lang('dashboard.Services Links')</h3>
                                                <div id="services-links-container" class="mb-4">
                                                    @foreach (old('ar.services_links', data_get($content, 'ar.services_links', [])) as $index => $item)
                                                        <div class="row service-link-row mb-3" data-index="{{ $index }}">
                                                            <div class="col-12 col-md-4">
                                                                <x-input.input-field
                                                                    name="ar[services_links][{{ $index }}][text]"
                                                                    id="ar_services_text_{{ $index }}"
                                                                    placeholder="{{ __('dashboard.Item Text (AR)') }}"
                                                                    label="{{ __('dashboard.Item Text (AR)') }}"
                                                                    :value="old('ar.services_links.' . $index . '.text', $item['text'] ?? '')" />
                                                            </div>
                                                            <div class="col-12 col-md-4">
                                                                <x-input.input-field
                                                                    name="en[services_links][{{ $index }}][text]"
                                                                    id="en_services_text_{{ $index }}"
                                                                    placeholder="{{ __('dashboard.Item Text (EN)') }}"
                                                                    label="{{ __('dashboard.Item Text (EN)') }}"
                                                                    :value="old('en.services_links.' . $index . '.text', data_get($content, 'en.services_links.' . $index . '.text', ''))" />
                                                            </div>
                                                            <div class="col-12 col-md-3">
                                                                <x-input.input-field
                                                                    name="ar[services_links][{{ $index }}][href]"
                                                                    id="services_href_{{ $index }}"
                                                                    placeholder="{{ __('dashboard.Item Link') }}"
                                                                    label="{{ __('dashboard.Item Link') }}"
                                                                    :value="old('ar.services_links.' . $index . '.href', data_get($content, 'ar.services_links.' . $index . '.href', ''))" />
                                                                <input type="hidden"
                                                                    name="en[services_links][{{ $index }}][href]"
                                                                    value="{{ old('en.services_links.' . $index . '.href', data_get($content, 'en.services_links.' . $index . '.href', data_get($content, 'ar.services_links.' . $index . '.href', ''))) }}">
                                                            </div>
                                                            <div class="col-12 col-md-1 d-flex align-items-center justify-content-center">
                                                                <button type="button" class="btn btn-sm btn-danger remove-service-link"
                                                                    title="{{ __('dashboard.delete') }}">
                                                                    @lang('dashboard.delete')
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <button type="button" class="btn btn-success btn-sm mt-2" id="add_service_link">
                                                    @lang('dashboard.add')
                                                </button>

                                                <hr class="my-3 text-muted" />
                                                <h3 class="text-muted">@lang('dashboard.Contact Details')</h3>
                                                <div class="row">
                                                    <x-input.input-field name="all[address]" id="footer_address"
                                                        placeholder="{{ __('dashboard.Address') }}"
                                                        label="{{ __('dashboard.Address') }}"
                                                        :value="old('all.address') ?? (data_get($content, 'all.address', ''))" />
                                                    <x-input.input-field name="all[phone]" id="footer_phone"
                                                        placeholder="{{ __('dashboard.Phone Number') }}"
                                                        label="{{ __('dashboard.Phone Number') }}"
                                                        :value="old('all.phone') ?? (data_get($content, 'all.phone', ''))" />
                                                </div>
                                                <div class="row">
                                                    <x-input.input-field name="all[email]" id="footer_email" type="email"
                                                        placeholder="{{ __('dashboard.Email Address') }}"
                                                        label="{{ __('dashboard.Email Address') }}"
                                                        :value="old('all.email') ?? (data_get($content, 'all.email', ''))" />
                                                </div>

                                                <div class="row">
                                                    <x-input.input-field name="ar[copyright]" id="ar_copyright"
                                                        placeholder="{{ __('dashboard.Copyright (AR)') }}"
                                                        label="{{ __('dashboard.Copyright (AR)') }}"
                                                        :value="old('ar.copyright') ?? ($content['ar']['copyright'] ?? '')" />
                                                    <x-input.input-field name="en[copyright]" id="en_copyright"
                                                        placeholder="{{ __('dashboard.Copyright (EN)') }}"
                                                        label="{{ __('dashboard.Copyright (EN)') }}"
                                                        :value="old('en.copyright') ?? ($content['en']['copyright'] ?? '')" />
                                                </div>
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
            let quickIndex = {{ count(old('ar.quick_links', data_get($content, 'ar.quick_links', []))) }};
            let serviceIndex = {{ count(old('ar.services_links', data_get($content, 'ar.services_links', []))) }};

            $('#add_quick_link').on('click', function() {
                const row = `
                    <div class="row quick-link-row mb-3" data-index="${quickIndex}">
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="ar_quick_text_${quickIndex}">@lang('dashboard.Item Text (AR)')</label>
                                <input type="text" name="ar[quick_links][${quickIndex}][text]" id="ar_quick_text_${quickIndex}" class="form-control" placeholder="@lang('dashboard.Item Text (AR)')">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="en_quick_text_${quickIndex}">@lang('dashboard.Item Text (EN)')</label>
                                <input type="text" name="en[quick_links][${quickIndex}][text]" id="en_quick_text_${quickIndex}" class="form-control" placeholder="@lang('dashboard.Item Text (EN)')">
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label class="form-label" for="quick_href_${quickIndex}">@lang('dashboard.Item Link')</label>
                                <input type="text" name="ar[quick_links][${quickIndex}][href]" id="quick_href_${quickIndex}" class="form-control" placeholder="@lang('dashboard.Item Link')">
                                <input type="hidden" name="en[quick_links][${quickIndex}][href]" value="">
                            </div>
                        </div>
                        <div class="col-12 col-md-1 d-flex align-items-center justify-content-center">
                            <button type="button" class="btn btn-sm btn-danger remove-quick-link" title="@lang('dashboard.delete')">
                                @lang('dashboard.delete')
                            </button>
                        </div>
                    </div>`;
                $('#quick-links-container').append(row);
                quickIndex++;
            });

            $('#add_service_link').on('click', function() {
                const row = `
                    <div class="row service-link-row mb-3" data-index="${serviceIndex}">
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="ar_services_text_${serviceIndex}">@lang('dashboard.Item Text (AR)')</label>
                                <input type="text" name="ar[services_links][${serviceIndex}][text]" id="ar_services_text_${serviceIndex}" class="form-control" placeholder="@lang('dashboard.Item Text (AR)')">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="en_services_text_${serviceIndex}">@lang('dashboard.Item Text (EN)')</label>
                                <input type="text" name="en[services_links][${serviceIndex}][text]" id="en_services_text_${serviceIndex}" class="form-control" placeholder="@lang('dashboard.Item Text (EN)')">
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label class="form-label" for="services_href_${serviceIndex}">@lang('dashboard.Item Link')</label>
                                <input type="text" name="ar[services_links][${serviceIndex}][href]" id="services_href_${serviceIndex}" class="form-control" placeholder="@lang('dashboard.Item Link')">
                                <input type="hidden" name="en[services_links][${serviceIndex}][href]" value="">
                            </div>
                        </div>
                        <div class="col-12 col-md-1 d-flex align-items-center justify-content-center">
                            <button type="button" class="btn btn-sm btn-danger remove-service-link" title="@lang('dashboard.delete')">
                                @lang('dashboard.delete')
                            </button>
                        </div>
                    </div>`;
                $('#services-links-container').append(row);
                serviceIndex++;
            });

            $(document).on('click', '.remove-quick-link', function(e) {
                e.preventDefault();
                $(this).closest('.quick-link-row').remove();
            });

            $(document).on('click', '.remove-service-link', function(e) {
                e.preventDefault();
                $(this).closest('.service-link-row').remove();
            });
        });
    </script>
@endpush
