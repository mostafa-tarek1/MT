@extends('base::components.dashboard.layouts.master')
@section('title', __('dashboard.Features Section'))

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="users-list-wrapper">
                    <x-breadcrumb.breadcrumb title="{{ __('dashboard.Features Section') }}" :breadcrumbs="[['name' => __('dashboard.Features Section')]]" />
                    <section id="column-selectors">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h4 class="card-title mb-0">{{ __('dashboard.Features Section') }}</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <x-form.form-component :route="route('features.store')" method="POST"
                                                enctype="multipart/form-data">
                                                <div id="features-container">
                                                    @foreach (old('ar.features', data_get($content, 'ar.features', [])) as $index => $feature)
                                                        <div class="row feature-row mb-2" data-index="{{ $index }}">
                                                                <x-input.input-field name="ar[features][{{ $index }}][title]"
                                                                    id="ar_feature_title_{{ $index }}"
                                                                    wrapperClass="col-12 col-md-5"
                                                                    placeholder="{{ __('dashboard.Feature Title (AR)') }}"
                                                                    label="{{ __('dashboard.Feature Title (AR)') }}"
                                                                    :value="old('ar.features.' . $index . '.title', $feature['title'] ?? '')" />
                                                            
                                                                <x-input.input-field name="en[features][{{ $index }}][title]"
                                                                    id="en_feature_title_{{ $index }}"
                                                                    wrapperClass="col-12 col-md-5"
                                                                    placeholder="{{ __('dashboard.Feature Title (EN)') }}"
                                                                    label="{{ __('dashboard.Feature Title (EN)') }}"
                                                                    :value="old('en.features.' . $index . '.title', data_get($content, 'en.features.' . $index . '.title', ''))" />
                                                            <div
                                                                class="col-12 col-md-2 d-flex align-items-center justify-content-center">
                                                                <button type="button"
                                                                    class="btn btn-sm btn-danger remove-feature"
                                                                    title="{{ __('dashboard.delete') }}">
                                                                    @lang('dashboard.delete')
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <button type="button" class="btn btn-success btn-sm mt-2" id="add_feature">
                                                    {{ __('dashboard.add_new') }}
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
        @if (session('errors') && session('errors')->count() > 0)
            $(document).ready(function () {
                @foreach (session('errors')->all() as $error)
                    iziToast.error({
                        title: '',
                        position: 'topLeft',
                        message: "{{ $error }}"
                    });
                @endforeach
                    });
        @endif
    </script>
    <script>
        $(function () {
            const MAX_ROWS = 8;
            let featureIndex = {{ count(old('ar.features', data_get($content, 'ar.features', []))) }};

            function updateAddButtonState() {
                const currentRows = $('.feature-row').length;
                if (currentRows >= MAX_ROWS) {
                    $('#add_feature').prop('disabled', true).addClass('disabled');
                } else {
                    $('#add_feature').prop('disabled', false).removeClass('disabled');
                }
            }

            // Initialize button state on page load
            // updateAddButtonState();

            $('#add_feature').on('click', function () {
                const currentRows = $('.feature-row').length;

                if (currentRows >= MAX_ROWS) {
                    iziToast.error({
                        title: '',
                        position: 'topLeft',
                        message: '{{ __('dashboard.Maximum number of features is 8') }}'
                    });                    
                    return;
                }

                const row = `
                        <div class="row feature-row" data-index="${featureIndex}">
                                <div class="form-group col-12 col-md-5">
                                    <label class="form-label" for="ar_feature_title_${featureIndex}">@lang('dashboard.Feature Title (AR)')</label>
                                    <input type="text" name="ar[features][${featureIndex}][title]" id="ar_feature_title_${featureIndex}" class="form-control" placeholder="@lang('dashboard.Feature Title (AR)')">
                                </div>
                            
                                <div class="form-group col-12 col-md-5">
                                    <label class="form-label" for="en_feature_title_${featureIndex}">@lang('dashboard.Feature Title (EN)')</label>
                                    <input type="text" name="en[features][${featureIndex}][title]" id="en_feature_title_${featureIndex}" class="form-control" placeholder="@lang('dashboard.Feature Title (EN)')">
                                </div>
                            <div class="col-12 col-md-2 d-flex align-items-center justify-content-center">
                                <button type="button" class="btn btn-sm btn-danger remove-feature" title="@lang('dashboard.delete')">
                                    @lang('dashboard.delete')
                                </button>
                            </div>
                        </div>`;
                $('#features-container').append(row);
                featureIndex++;
                // updateAddButtonState();
            });

            $(document).on('click', '.remove-feature', function (e) {
                e.preventDefault();
                e.stopPropagation();
                $(this).closest('.feature-row').remove();
                // updateAddButtonState();
            });
        });
    </script>
@endpush