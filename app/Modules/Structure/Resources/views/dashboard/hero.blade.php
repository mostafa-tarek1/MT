@extends('base::components.dashboard.layouts.master')
@section('title', __('dashboard.Hero Section'))

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- page wrapper start -->
                <section class="users-list-wrapper">
                    <x-breadcrumb.breadcrumb title="{{ __('dashboard.Hero Section') }}" :breadcrumbs="[['name' => __('dashboard.Hero Section')]]" />
                    <!-- Form Card -->
                    <section id="column-selectors">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h4 class="card-title mb-0">{{ __('dashboard.Hero Section') }}</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <x-form.form-component :route="route('hero.store')" method="POST"
                                                enctype="multipart/form-data">
                                                <div class="row">
                                                    <x-input.input-field name="ar[title_primary]" id="ar_title_primary"
                                                        placeholder="{{ __('dashboard.Title Primary (AR)') }}"
                                                        label="{{ __('dashboard.Title Primary (AR)') }}"
                                                        :value="old('ar.title_primary') ?? ($content['ar']['title_primary'] ?? '')" />
                                                    {{-- Title Primary EN --}}
                                                    <x-input.input-field name="en[title_primary]" id="en_title_primary"
                                                        placeholder="{{ __('dashboard.Title Primary (EN)') }}"
                                                        label="{{ __('dashboard.Title Primary (EN)') }}"
                                                        :value="old('en.title_primary') ?? ($content['en']['title_primary'] ?? '')" />
                                                </div>
                                                <div class="row">
                                                    {{-- Title Accent AR --}}
                                                    <x-input.input-field name="ar[title_accent]" id="ar_title_accent"
                                                        placeholder="{{ __('dashboard.Title Accent (AR)') }}"
                                                        label="{{ __('dashboard.Title Accent (AR)') }}"
                                                        :value="old('ar.title_accent') ?? ($content['ar']['title_accent'] ?? '')" />
                                                    {{-- Title Accent EN --}}
                                                    <x-input.input-field name="en[title_accent]" id="en_title_accent"
                                                        placeholder="{{ __('dashboard.Title Accent (EN)') }}"
                                                        label="{{ __('dashboard.Title Accent (EN)') }}"
                                                        :value="old('en.title_accent') ?? ($content['en']['title_accent'] ?? '')" />
                                                </div>
                                                <div class="row">
                                                        {{-- Subtitle AR --}}
                                                    <x-input.input-field name="ar[subtitle]" id="ar_subtitle"
                                                        placeholder="{{ __('dashboard.Subtitle (AR)') }}"
                                                        label="{{ __('dashboard.Subtitle (AR)') }}"
                                                        :value="old('ar.subtitle') ?? ($content['ar']['subtitle'] ?? '')" />

                                                        {{-- Subtitle EN --}}
                                                    <x-input.input-field name="en[subtitle]" id="en_subtitle"
                                                        placeholder="{{ __('dashboard.Subtitle (EN)') }}"
                                                        label="{{ __('dashboard.Subtitle (EN)') }}"
                                                        :value="old('en.subtitle') ?? ($content['en']['subtitle'] ?? '')" />
                                                </div>
                                                <div class="row">
                                                        {{-- Button Text AR --}}
                                                    <x-input.input-field name="ar[button_text]" id="ar_button_text"
                                                        placeholder="{{ __('dashboard.Button Text (AR)') }}"
                                                        label="{{ __('dashboard.Button Text (AR)') }}"
                                                        :value="old('ar.button_text') ?? ($content['ar']['button_text'] ?? '')" />

                                                        {{-- Button Text EN --}}
                                                    <x-input.input-field name="en[button_text]" id="en_button_text"
                                                        placeholder="{{ __('dashboard.Button Text (EN)') }}"
                                                        label="{{ __('dashboard.Button Text (EN)') }}"
                                                        :value="old('en.button_text') ?? ($content['en']['button_text'] ?? '')" />
                                                    </div>
                                                    <div class="row">
                                                    {{-- Button Link AR --}}
                                                    <x-input.input-field name="ar[button_link]" id="ar_button_link"
                                                        placeholder="{{ __('dashboard.Button Link (AR)') }}"
                                                        label="{{ __('dashboard.Button Link (AR)') }}"
                                                        :value="old('ar.button_link') ?? ($content['ar']['button_link'] ?? '')" />

                                                        {{-- Button Link EN --}}
                                                    <x-input.input-field name="en[button_link]" id="en_button_link"
                                                        placeholder="{{ __('dashboard.Button Link (EN)') }}"
                                                        label="{{ __('dashboard.Button Link (EN)') }}"
                                                        :value="old('en.button_link') ?? ($content['en']['button_link'] ?? '')" />
                                                    </div>{{-- Client Logos --}}
                                                    <div class="form-group">
                                                        <label class="form-label">{{ __('dashboard.Client Logos') }}</label>
                                                        <div id="clientLogosContainer">
                                                            @foreach (old('all.client_logos', data_get($content, 'en.client_logos', [])) as $key => $client_logo)
                                                                <div class="row clientLogo-row mb-3 align-items-center"
                                                                    data-index="{{ $key }}">
                                                                    <div class="col-12 col-md-4">
                                                                        @php
    $fileId = 1000 + $key;
    $imageId = 'image_' . $fileId;
                                                                        @endphp
                                                                        <x-input.image-input
                                                                            name="client_logos[{{ $key }}][icon]"
                                                                            :fileId="$fileId" :id="$imageId"
                                                                            :label="__('dashboard.client_logo')"
                                                                            :value="old('old_file.' . $fileId, $client_logo['icon'] ?? '')" wrapperClass="col-12"
                                                                            previewClass="col-12 mt-2" :showPreview="true"
                                                                            previewMaxHeight="80px"
                                                                            enName="en[client_logos][{{ $key }}][icon]"
                                                                            arName="ar[client_logos][{{ $key }}][icon]" />
                                                                    </div>
                                                                    <div
                                                                        class="col-12 col-md-1 d-flex align-items-center justify-content-center mt-3 mt-md-0">
                                                                        <button type="button"
                                                                            class="btn btn-sm btn-danger remove-client-logo"
                                                                            title="{{ __('dashboard.delete') }}">
                                                                            حذف
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <button type="button" class="btn btn-primary btn-sm"
                                                            id="addClientLogo">{{ __('dashboard.add_new') }}</button>
                                                    </div>
                                            </x-form.form-component>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- /Form Card -->
                </section>
                <!-- page wrapper end -->
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
            @php
$clientLogos = old('all.client_logos', data_get($content, 'en.client_logos', []));
if (!is_array($clientLogos)) {
    $clientLogos = [];
}
            @endphp
            let logoIndex = {{ count($clientLogos) }};

            // Add new logo
            $('#addClientLogo').on('click', function () {
                const fileId = 1000 + logoIndex;
                const imageId = 'image_' + fileId;
                const row = `
                        <div class="row clientLogo-row mb-3" data-index="${logoIndex}">
                            <div class="col-12 col-md-4">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group w-100">
                                            <label class="form-label" for="${imageId}">@lang('dashboard.client_logo')</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input name="en[client_logos][${logoIndex}][icon]" type="hidden" value="file_${fileId}">
                                                    <input name="ar[client_logos][${logoIndex}][icon]" type="hidden" value="file_${fileId}">
                                                    <input name="file[${fileId}]" type="file" class="custom-file-input" id="${imageId}" accept="image/*">
                                                    <label class="custom-file-label" for="${imageId}">@lang('dashboard.choose_file')</label>
                                                    <input name="old_file[${fileId}]" type="hidden" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <img id="imagePreview${fileId}" src="#" alt="Preview" class="img-thumbnail d-none" style="max-height: 80px;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-1 d-flex align-items-center justify-content-center mt-3 mt-md-0">
                                <button type="button" class="btn btn-sm btn-danger remove-client-logo" title="@lang('dashboard.delete')">
                                                                            حذف
                                </button>
                            </div>
                        </div>`;
                $('#clientLogosContainer').append(row);

                // Initialize file input functionality for the new row
                $(`#${imageId}`).on('change', function () {
                    var fileName = $(this).val().split('\\').pop();
                    $(this).siblings('.custom-file-label').html(fileName || '@lang('dashboard.choose_file')');

                    // Preview image
                    if (this.files && this.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            $(`#imagePreview${fileId}`)
                                .attr('src', e.target.result)
                                .removeClass('d-none');
                        };
                        reader.readAsDataURL(this.files[0]);
                    }
                });

                logoIndex++;
            });

            // Remove logo
            $(document).on('click', '.remove-client-logo', function (e) {
                e.preventDefault();
                $(this).closest('.clientLogo-row').remove();
            });
        });
    </script>
@endpush