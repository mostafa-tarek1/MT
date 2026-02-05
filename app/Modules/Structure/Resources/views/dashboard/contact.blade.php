@extends('base::components.dashboard.layouts.master')
@section('title', __('dashboard.Contact Section'))

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="users-list-wrapper">
                    <x-breadcrumb.breadcrumb title="{{ __('dashboard.Contact Section') }}" :breadcrumbs="[['name' => __('dashboard.Contact Section')]]" />
                    <section id="column-selectors">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h4 class="card-title mb-0">{{ __('dashboard.Contact Section') }}</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <x-form.form-component :route="route('contact.store')" method="POST">
                                                <h3 class="text-muted">@lang('dashboard.Form Section')</h3>
                                                <x-input.input-field name="ar[form_title]" id="ar_form_title"
                                                    placeholder="{{ __('dashboard.Form Title (AR)') }}"
                                                    label="{{ __('dashboard.Form Title (AR)') }}" :value="old('ar.form_title') ?? ($content['ar']['form_title'] ?? '')" />
                                                <x-input.input-field name="en[form_title]" id="en_form_title"
                                                    placeholder="{{ __('dashboard.Form Title (EN)') }}"
                                                    label="{{ __('dashboard.Form Title (EN)') }}" :value="old('en.form_title') ?? ($content['en']['form_title'] ?? '')" />
                                                <x-editor.quill id="ar_form_subtitle"
                                                    label="{{ __('dashboard.Form Subtitle (AR)') }}" name="ar[form_subtitle]"
                                                    :value="old('ar.form_subtitle') ?? ($content['ar']['form_subtitle'] ?? '')" />
                                                <x-editor.quill id="en_form_subtitle"
                                                    label="{{ __('dashboard.Form Subtitle (EN)') }}" name="en[form_subtitle]"
                                                    :value="old('en.form_subtitle') ?? ($content['en']['form_subtitle'] ?? '')" />
                                                
                                                <hr class="my-3 text-muted"/>
                                                <h3 class="text-muted">@lang('dashboard.Contact Info Section')</h3>
                                                <x-input.input-field name="ar[info_title]" id="ar_info_title"
                                                    placeholder="{{ __('dashboard.Info Title (AR)') }}"
                                                    label="{{ __('dashboard.Info Title (AR)') }}" :value="old('ar.info_title') ?? ($content['ar']['info_title'] ?? '')" />
                                                <x-input.input-field name="en[info_title]" id="en_info_title"
                                                    placeholder="{{ __('dashboard.Info Title (EN)') }}"
                                                    label="{{ __('dashboard.Info Title (EN)') }}" :value="old('en.info_title') ?? ($content['en']['info_title'] ?? '')" />
                                                <x-editor.quill id="ar_info_description"
                                                    label="{{ __('dashboard.Info Description (AR)') }}" name="ar[info_description]"
                                                    :value="old('ar.info_description') ?? ($content['ar']['info_description'] ?? '')" />
                                                <x-editor.quill id="en_info_description"
                                                    label="{{ __('dashboard.Info Description (EN)') }}" name="en[info_description]"
                                                    :value="old('en.info_description') ?? ($content['en']['info_description'] ?? '')" />
                                                
                                                <hr class="my-3 text-muted"/>
                                                <h3 class="text-muted">@lang('dashboard.Contact Details')</h3>
                                                <x-input.input-field name="ar[phone_label]" id="ar_phone_label"
                                                    placeholder="{{ __('dashboard.Phone Label (AR)') }}"
                                                    label="{{ __('dashboard.Phone Label (AR)') }}" :value="old('ar.phone_label') ?? ($content['ar']['phone_label'] ?? '')" />
                                                <x-input.input-field name="en[phone_label]" id="en_phone_label"
                                                    placeholder="{{ __('dashboard.Phone Label (EN)') }}"
                                                    label="{{ __('dashboard.Phone Label (EN)') }}" :value="old('en.phone_label') ?? ($content['en']['phone_label'] ?? '')" />
                                                <x-input.input-field name="all[phone]" id="phone"
                                                    placeholder="{{ __('dashboard.Phone Number') }}"
                                                    label="{{ __('dashboard.Phone Number') }}" :value="old('all.phone') ?? (data_get($content, 'all.phone', ''))" />
                                                
                                                <x-input.input-field name="ar[email_label]" id="ar_email_label"
                                                    placeholder="{{ __('dashboard.Email Label (AR)') }}"
                                                    label="{{ __('dashboard.Email Label (AR)') }}" :value="old('ar.email_label') ?? ($content['ar']['email_label'] ?? '')" />
                                                <x-input.input-field name="en[email_label]" id="en_email_label"
                                                    placeholder="{{ __('dashboard.Email Label (EN)') }}"
                                                    label="{{ __('dashboard.Email Label (EN)') }}" :value="old('en.email_label') ?? ($content['en']['email_label'] ?? '')" />
                                                <x-input.input-field name="all[email]" id="email" type="email"
                                                    placeholder="{{ __('dashboard.Email Address') }}"
                                                    label="{{ __('dashboard.Email Address') }}" :value="old('all.email') ?? (data_get($content, 'all.email', ''))" />
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
                    toastr.error("{{ $error }}");
                @endforeach
            });
        @endif
    </script>
@endpush

