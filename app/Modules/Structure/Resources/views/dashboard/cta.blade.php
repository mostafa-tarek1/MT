@extends('base::components.dashboard.layouts.master')
@section('title', __('dashboard.CTA Section'))

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="users-list-wrapper">
                    <x-breadcrumb.breadcrumb title="{{ __('dashboard.CTA Section') }}" :breadcrumbs="[['name' => __('dashboard.CTA Section')]]" />
                    <section id="column-selectors">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h4 class="card-title mb-0">{{ __('dashboard.CTA Section') }}</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <x-form.form-component :route="route('cta.store')" method="POST">
                                                <x-input.input-field name="ar[title]" id="ar_title"
                                                    placeholder="{{ __('dashboard.Title (AR)') }}"
                                                    label="{{ __('dashboard.Title (AR)') }}" :value="old('ar.title') ?? ($content['ar']['title'] ?? '')" />
                                                <x-input.input-field name="en[title]" id="en_title"
                                                    placeholder="{{ __('dashboard.Title (EN)') }}"
                                                    label="{{ __('dashboard.Title (EN)') }}" :value="old('en.title') ?? ($content['en']['title'] ?? '')" />
                                                <x-input.input-field name="ar[button_text]" id="ar_button_text"
                                                    placeholder="{{ __('dashboard.Button Text (AR)') }}"
                                                    label="{{ __('dashboard.Button Text (AR)') }}" :value="old('ar.button_text') ?? ($content['ar']['button_text'] ?? '')" />
                                                <x-input.input-field name="en[button_text]" id="en_button_text"
                                                    placeholder="{{ __('dashboard.Button Text (EN)') }}"
                                                    label="{{ __('dashboard.Button Text (EN)') }}" :value="old('en.button_text') ?? ($content['en']['button_text'] ?? '')" />
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

