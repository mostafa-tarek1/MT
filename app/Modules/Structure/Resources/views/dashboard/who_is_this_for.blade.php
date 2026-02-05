@extends('base::components.dashboard.layouts.master')
@section('title', __('dashboard.Who Is This For Section'))

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="users-list-wrapper">
                    <x-breadcrumb.breadcrumb title="{{ __('dashboard.Who Is This For Section') }}" :breadcrumbs="[['name' => __('dashboard.Who Is This For Section')]]" />
                    <section id="column-selectors">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h4 class="card-title mb-0">{{ __('dashboard.Who Is This For Section') }}</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <x-form.form-component :route="route('who_is_this_for.store')" method="POST" enctype="multipart/form-data">
                                                @php
                                                    $fileId = 700;
                                                    $imageId = 'who_is_this_for_image_' . $fileId;
                                                @endphp
                                                <x-input.image-input 
                                                    name="image"
                                                    :fileId="$fileId"
                                                    :id="$imageId"
                                                    :label="__('dashboard.image')"
                                                    :value="old('old_file.' . $fileId, $content['ar']['image'] ?? '')"
                                                    wrapperClass="col-md-6"
                                                    previewClass="col-md-6"
                                                    :showPreview="true"
                                                    previewMaxHeight="200px"
                                                    enName="en[image]"
                                                    arName="ar[image]"
                                                />
                                                
                                                <x-input.input-field name="ar[title]" id="ar_title"
                                                    placeholder="{{ __('dashboard.Title (AR)') }}"
                                                    label="{{ __('dashboard.Title (AR)') }}" :value="old('ar.title') ?? ($content['ar']['title'] ?? '')" />
                                                <x-input.input-field name="en[title]" id="en_title"
                                                    placeholder="{{ __('dashboard.Title (EN)') }}"
                                                    label="{{ __('dashboard.Title (EN)') }}" :value="old('en.title') ?? ($content['en']['title'] ?? '')" />
                                                
                                                <hr class="my-3 text-muted"/>
                                                <h3 class="text-muted">@lang('dashboard.Items')</h3>
                                                <div id="items-container" class="mb-4">
                                                    @foreach (old('ar.items', data_get($content, 'ar.items', [])) as $index => $item)
                                                        <div class="row item-row mb-3" data-index="{{ $index }}">
                                                            <div class="col-12 col-md-5">
                                                                <x-input.input-field 
                                                                    name="ar[items][{{ $index }}][text]" 
                                                                    id="ar_item_text_{{ $index }}"
                                                                    placeholder="{{ __('dashboard.Item Text (AR)') }}"
                                                                    label="{{ __('dashboard.Item Text (AR)') }}"
                                                                    :value="old('ar.items.' . $index . '.text', $item['text'] ?? '')" />
                                                            </div>
                                                            <div class="col-12 col-md-5">
                                                                <x-input.input-field 
                                                                    name="en[items][{{ $index }}][text]" 
                                                                    id="en_item_text_{{ $index }}"
                                                                    placeholder="{{ __('dashboard.Item Text (EN)') }}"
                                                                    label="{{ __('dashboard.Item Text (EN)') }}"
                                                                    :value="old('en.items.' . $index . '.text', data_get($content, 'en.items.' . $index . '.text', ''))" />
                                                            </div>
                                                            <div class="col-12 col-md-2 d-flex align-items-center justify-content-center">
                                                                <i class="ti ti-trash remove-item" style="color: red; cursor: pointer; font-size: 1.2em;"></i>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <button type="button" class="btn btn-success btn-sm mt-2" id="add_item">
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
        @if (session('errors') && session('errors')->count() > 0)
            $(document).ready(function () {
                @foreach (session('errors')->all() as $error)
                    toastr.error("{{ $error }}");
                @endforeach
            });
        @endif
    </script>
    <script>
        $(function() {
            let itemIndex = {{ count(old('ar.items', data_get($content, 'ar.items', []))) }};

            $('#add_item').on('click', function() {
                const row = `
                    <div class="row item-row mb-3" data-index="${itemIndex}">
                        <div class="col-12 col-md-5">
                            <div class="form-group">
                                <label class="form-label" for="ar_item_text_${itemIndex}">@lang('dashboard.Item Text (AR)')</label>
                                <input type="text" name="ar[items][${itemIndex}][text]" id="ar_item_text_${itemIndex}" class="form-control" placeholder="@lang('dashboard.Item Text (AR)')">
                            </div>
                        </div>
                        <div class="col-12 col-md-5">
                            <div class="form-group">
                                <label class="form-label" for="en_item_text_${itemIndex}">@lang('dashboard.Item Text (EN)')</label>
                                <input type="text" name="en[items][${itemIndex}][text]" id="en_item_text_${itemIndex}" class="form-control" placeholder="@lang('dashboard.Item Text (EN)')">
                            </div>
                        </div>
                        <div class="col-12 col-md-2 d-flex align-items-center justify-content-center">
                            <i class="ti ti-trash remove-item" style="color: red; cursor: pointer; font-size: 1.2em;"></i>
                        </div>
                    </div>`;
                $('#items-container').append(row);
                itemIndex++;
            });

            $(document).on('click', '.remove-item', function() {
                $(this).closest('.item-row').remove();
            });
        });
    </script>
@endpush

