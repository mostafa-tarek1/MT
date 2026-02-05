@extends('base::components.dashboard.layouts.master')
@section('title', __('dashboard.Quote Modal'))

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row"></div>
            <div class="content-body">
                <section class="users-list-wrapper">
                    <x-breadcrumb.breadcrumb title="{{ __('dashboard.Quote Modal') }}"
                        :breadcrumbs="[['name' => __('dashboard.Quote Modal')]]" />
                    <section id="column-selectors">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h4 class="card-title mb-0">{{ __('dashboard.Quote Modal') }}</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <x-form.form-component :route="route('quote_modal.store')" method="POST">
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
                                                    <x-input.input-field name="ar[name_label]" id="ar_name_label"
                                                        placeholder="{{ __('dashboard.Name Label (AR)') }}"
                                                        label="{{ __('dashboard.Name Label (AR)') }}"
                                                        :value="old('ar.name_label') ?? ($content['ar']['name_label'] ?? '')" />
                                                    <x-input.input-field name="en[name_label]" id="en_name_label"
                                                        placeholder="{{ __('dashboard.Name Label (EN)') }}"
                                                        label="{{ __('dashboard.Name Label (EN)') }}"
                                                        :value="old('en.name_label') ?? ($content['en']['name_label'] ?? '')" />
                                                </div>
                                                <div class="row">
                                                    <x-input.input-field name="ar[phone_label]" id="ar_phone_label"
                                                        placeholder="{{ __('dashboard.Phone Label (AR)') }}"
                                                        label="{{ __('dashboard.Phone Label (AR)') }}"
                                                        :value="old('ar.phone_label') ?? ($content['ar']['phone_label'] ?? '')" />
                                                    <x-input.input-field name="en[phone_label]" id="en_phone_label"
                                                        placeholder="{{ __('dashboard.Phone Label (EN)') }}"
                                                        label="{{ __('dashboard.Phone Label (EN)') }}"
                                                        :value="old('en.phone_label') ?? ($content['en']['phone_label'] ?? '')" />
                                                </div>
                                                <div class="row">
                                                    <x-input.input-field name="ar[products_label]" id="ar_products_label"
                                                        placeholder="{{ __('dashboard.Products Label (AR)') }}"
                                                        label="{{ __('dashboard.Products Label (AR)') }}"
                                                        :value="old('ar.products_label') ?? ($content['ar']['products_label'] ?? '')" />
                                                    <x-input.input-field name="en[products_label]" id="en_products_label"
                                                        placeholder="{{ __('dashboard.Products Label (EN)') }}"
                                                        label="{{ __('dashboard.Products Label (EN)') }}"
                                                        :value="old('en.products_label') ?? ($content['en']['products_label'] ?? '')" />
                                                </div>
                                                <div class="row">
                                                    <x-input.input-field name="ar[add_product_text]" id="ar_add_product_text"
                                                        placeholder="{{ __('dashboard.Add Product Text (AR)') }}"
                                                        label="{{ __('dashboard.Add Product Text (AR)') }}"
                                                        :value="old('ar.add_product_text') ?? ($content['ar']['add_product_text'] ?? '')" />
                                                    <x-input.input-field name="en[add_product_text]" id="en_add_product_text"
                                                        placeholder="{{ __('dashboard.Add Product Text (EN)') }}"
                                                        label="{{ __('dashboard.Add Product Text (EN)') }}"
                                                        :value="old('en.add_product_text') ?? ($content['en']['add_product_text'] ?? '')" />
                                                </div>
                                                <div class="row">
                                                    <x-input.input-field name="ar[submit_text]" id="ar_submit_text"
                                                        placeholder="{{ __('dashboard.Submit Text (AR)') }}"
                                                        label="{{ __('dashboard.Submit Text (AR)') }}"
                                                        :value="old('ar.submit_text') ?? ($content['ar']['submit_text'] ?? '')" />
                                                    <x-input.input-field name="en[submit_text]" id="en_submit_text"
                                                        placeholder="{{ __('dashboard.Submit Text (EN)') }}"
                                                        label="{{ __('dashboard.Submit Text (EN)') }}"
                                                        :value="old('en.submit_text') ?? ($content['en']['submit_text'] ?? '')" />
                                                </div>
                                                <div class="row">
                                                    <x-input.input-field name="ar[cancel_text]" id="ar_cancel_text"
                                                        placeholder="{{ __('dashboard.Cancel Text (AR)') }}"
                                                        label="{{ __('dashboard.Cancel Text (AR)') }}"
                                                        :value="old('ar.cancel_text') ?? ($content['ar']['cancel_text'] ?? '')" />
                                                    <x-input.input-field name="en[cancel_text]" id="en_cancel_text"
                                                        placeholder="{{ __('dashboard.Cancel Text (EN)') }}"
                                                        label="{{ __('dashboard.Cancel Text (EN)') }}"
                                                        :value="old('en.cancel_text') ?? ($content['en']['cancel_text'] ?? '')" />
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
