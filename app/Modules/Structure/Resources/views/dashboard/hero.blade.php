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
                                                    <x-input.input-field name="ar[title]" id="ar_title"
                                                        placeholder="{{ __('dashboard.Title (AR)') }}"
                                                        label="{{ __('dashboard.Title (AR)') }}"
                                                        :value="old('ar.title') ?? ($content['ar']['title'] ?? '')" />
                                                    <x-input.input-field name="en[title]" id="en_title"
                                                        placeholder="{{ __('dashboard.Title (EN)') }}"
                                                        label="{{ __('dashboard.Title (EN)') }}"
                                                        :value="old('en.title') ?? ($content['en']['title'] ?? '')" />
                                                </div>
                                                <div class="row">
                                                    <x-input.input-field name="ar[highlight]" id="ar_highlight"
                                                        placeholder="{{ __('dashboard.Highlight (AR)') }}"
                                                        label="{{ __('dashboard.Highlight (AR)') }}"
                                                        :value="old('ar.highlight') ?? ($content['ar']['highlight'] ?? '')" />
                                                    <x-input.input-field name="en[highlight]" id="en_highlight"
                                                        placeholder="{{ __('dashboard.Highlight (EN)') }}"
                                                        label="{{ __('dashboard.Highlight (EN)') }}"
                                                        :value="old('en.highlight') ?? ($content['en']['highlight'] ?? '')" />
                                                </div>
                                                <div class="row">
                                                    <x-editor.quill id="ar_description"
                                                        label="{{ __('dashboard.Description (AR)') }}"
                                                        name="ar[description]"
                                                        :value="old('ar.description') ?? ($content['ar']['description'] ?? '')" />
                                                    <x-editor.quill id="en_description"
                                                        label="{{ __('dashboard.Description (EN)') }}"
                                                        name="en[description]"
                                                        :value="old('en.description') ?? ($content['en']['description'] ?? '')" />
                                                </div>
                                                <div class="row">
                                                    <x-input.input-field name="ar[primary_button_text]" id="ar_primary_button_text"
                                                        placeholder="{{ __('dashboard.Primary Button Text (AR)') }}"
                                                        label="{{ __('dashboard.Primary Button Text (AR)') }}"
                                                        :value="old('ar.primary_button_text') ?? ($content['ar']['primary_button_text'] ?? '')" />
                                                    <x-input.input-field name="en[primary_button_text]" id="en_primary_button_text"
                                                        placeholder="{{ __('dashboard.Primary Button Text (EN)') }}"
                                                        label="{{ __('dashboard.Primary Button Text (EN)') }}"
                                                        :value="old('en.primary_button_text') ?? ($content['en']['primary_button_text'] ?? '')" />
                                                </div>
                                                <div class="row">
                                                    <x-input.input-field name="ar[primary_button_link]" id="ar_primary_button_link"
                                                        placeholder="{{ __('dashboard.Primary Button Link (AR)') }}"
                                                        label="{{ __('dashboard.Primary Button Link (AR)') }}"
                                                        :value="old('ar.primary_button_link') ?? ($content['ar']['primary_button_link'] ?? '')" />
                                                    <x-input.input-field name="en[primary_button_link]" id="en_primary_button_link"
                                                        placeholder="{{ __('dashboard.Primary Button Link (EN)') }}"
                                                        label="{{ __('dashboard.Primary Button Link (EN)') }}"
                                                        :value="old('en.primary_button_link') ?? ($content['en']['primary_button_link'] ?? '')" />
                                                </div>
                                                <div class="row">
                                                    <x-input.input-field name="ar[secondary_button_text]" id="ar_secondary_button_text"
                                                        placeholder="{{ __('dashboard.Secondary Button Text (AR)') }}"
                                                        label="{{ __('dashboard.Secondary Button Text (AR)') }}"
                                                        :value="old('ar.secondary_button_text') ?? ($content['ar']['secondary_button_text'] ?? '')" />
                                                    <x-input.input-field name="en[secondary_button_text]" id="en_secondary_button_text"
                                                        placeholder="{{ __('dashboard.Secondary Button Text (EN)') }}"
                                                        label="{{ __('dashboard.Secondary Button Text (EN)') }}"
                                                        :value="old('en.secondary_button_text') ?? ($content['en']['secondary_button_text'] ?? '')" />
                                                </div>
                                                <div class="row">
                                                    <x-input.input-field name="ar[secondary_button_link]" id="ar_secondary_button_link"
                                                        placeholder="{{ __('dashboard.Secondary Button Link (AR)') }}"
                                                        label="{{ __('dashboard.Secondary Button Link (AR)') }}"
                                                        :value="old('ar.secondary_button_link') ?? ($content['ar']['secondary_button_link'] ?? '')" />
                                                    <x-input.input-field name="en[secondary_button_link]" id="en_secondary_button_link"
                                                        placeholder="{{ __('dashboard.Secondary Button Link (EN)') }}"
                                                        label="{{ __('dashboard.Secondary Button Link (EN)') }}"
                                                        :value="old('en.secondary_button_link') ?? ($content['en']['secondary_button_link'] ?? '')" />
                                                </div>
                                                <div class="row">
                                                    @php
                                                        $fileId = 200;
                                                        $imageId = 'hero_image_' . $fileId;
                                                    @endphp
                                                    <x-input.image-input name="image" :fileId="$fileId" :id="$imageId"
                                                        :label="__('dashboard.image')"
                                                        :value="old('old_file.' . $fileId, $content['ar']['image'] ?? '')"
                                                        wrapperClass="col-md-6" previewClass="col-md-6"
                                                        :showPreview="true" previewMaxHeight="200px"
                                                        enName="en[image]" arName="ar[image]" />
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
@endpush