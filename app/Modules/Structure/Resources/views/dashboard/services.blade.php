@extends('base::components.dashboard.layouts.master')
@section('title', __('dashboard.Services Section'))

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row"></div>
            <div class="content-body">
                <section class="users-list-wrapper">
                    <x-breadcrumb.breadcrumb title="{{ __('dashboard.Services Section') }}"
                        :breadcrumbs="[['name' => __('dashboard.Services Section')]]" />
                    <section id="column-selectors">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h4 class="card-title mb-0">{{ __('dashboard.Services Section') }}</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <x-form.form-component :route="route('services.store')" method="POST"
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
                                                    <x-input.input-field name="ar[subtitle]" id="ar_subtitle"
                                                        placeholder="{{ __('dashboard.Subtitle (AR)') }}"
                                                        label="{{ __('dashboard.Subtitle (AR)') }}"
                                                        :value="old('ar.subtitle') ?? ($content['ar']['subtitle'] ?? '')" />
                                                    <x-input.input-field name="en[subtitle]" id="en_subtitle"
                                                        placeholder="{{ __('dashboard.Subtitle (EN)') }}"
                                                        label="{{ __('dashboard.Subtitle (EN)') }}"
                                                        :value="old('en.subtitle') ?? ($content['en']['subtitle'] ?? '')" />
                                                </div>

                                                <hr class="my-3 text-muted" />
                                                <h3 class="text-muted">@lang('dashboard.Services Items')</h3>
                                                <div id="services-container" class="mb-4">
                                                    @foreach (old('ar.items', data_get($content, 'ar.items', [])) as $index => $item)
                                                        <div class="row service-row mb-3" data-index="{{ $index }}">
                                                            <div class="col-12 col-md-4">
                                                                <x-input.input-field
                                                                    name="ar[items][{{ $index }}][title]"
                                                                    id="ar_service_title_{{ $index }}"
                                                                    placeholder="{{ __('dashboard.Item Title (AR)') }}"
                                                                    label="{{ __('dashboard.Item Title (AR)') }}"
                                                                    :value="old('ar.items.' . $index . '.title', $item['title'] ?? '')" />
                                                                <x-editor.quill id="ar_service_text_{{ $index }}"
                                                                    label="{{ __('dashboard.Item Text (AR)') }}"
                                                                    name="ar[items][{{ $index }}][text]"
                                                                    :value="old('ar.items.' . $index . '.text', $item['text'] ?? '')" />
                                                            </div>
                                                            <div class="col-12 col-md-4">
                                                                <x-input.input-field
                                                                    name="en[items][{{ $index }}][title]"
                                                                    id="en_service_title_{{ $index }}"
                                                                    placeholder="{{ __('dashboard.Item Title (EN)') }}"
                                                                    label="{{ __('dashboard.Item Title (EN)') }}"
                                                                    :value="old('en.items.' . $index . '.title', data_get($content, 'en.items.' . $index . '.title', ''))" />
                                                                <x-editor.quill id="en_service_text_{{ $index }}"
                                                                    label="{{ __('dashboard.Item Text (EN)') }}"
                                                                    name="en[items][{{ $index }}][text]"
                                                                    :value="old('en.items.' . $index . '.text', data_get($content, 'en.items.' . $index . '.text', ''))" />
                                                            </div>
                                                            <div class="col-12 col-md-3">
                                                                @php
                                                                    $fileId = 400 + $index;
                                                                    $imageId = 'service_image_' . $fileId;
                                                                @endphp
                                                                <x-input.image-input name="items[{{ $index }}][image]"
                                                                    :fileId="$fileId" :id="$imageId"
                                                                    :label="__('dashboard.image')"
                                                                    :value="old('old_file.' . $fileId, $item['image'] ?? '')"
                                                                    wrapperClass="col-12" previewClass="col-12 mt-2"
                                                                    :showPreview="true" previewMaxHeight="100px"
                                                                    enName="en[items][{{ $index }}][image]"
                                                                    arName="ar[items][{{ $index }}][image]" />
                                                            </div>
                                                            <div class="col-12 col-md-1 d-flex align-items-center justify-content-center">
                                                                <button type="button" class="btn btn-sm btn-danger remove-service"
                                                                    title="{{ __('dashboard.delete') }}">
                                                                    @lang('dashboard.delete')
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <button type="button" class="btn btn-success btn-sm mt-2" id="add_service">
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
            let serviceIndex = {{ count(old('ar.items', data_get($content, 'ar.items', []))) }};

            $('#add_service').on('click', function() {
                const fileId = 400 + serviceIndex;
                const imageId = 'service_image_' + fileId;
                const row = `
                    <div class="row service-row mb-3" data-index="${serviceIndex}">
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="ar_service_title_${serviceIndex}">@lang('dashboard.Item Title (AR)')</label>
                                <input type="text" name="ar[items][${serviceIndex}][title]" id="ar_service_title_${serviceIndex}" class="form-control" placeholder="@lang('dashboard.Item Title (AR)')">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="ar_service_text_${serviceIndex}">@lang('dashboard.Item Text (AR)')</label>
                                <div id="ar_service_text_${serviceIndex}" style="min-height: 200px;"></div>
                                <textarea id="ar_service_text_${serviceIndex}_hidden" name="ar[items][${serviceIndex}][text]" class="d-none"></textarea>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="en_service_title_${serviceIndex}">@lang('dashboard.Item Title (EN)')</label>
                                <input type="text" name="en[items][${serviceIndex}][title]" id="en_service_title_${serviceIndex}" class="form-control" placeholder="@lang('dashboard.Item Title (EN)')">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="en_service_text_${serviceIndex}">@lang('dashboard.Item Text (EN)')</label>
                                <div id="en_service_text_${serviceIndex}" style="min-height: 200px;"></div>
                                <textarea id="en_service_text_${serviceIndex}_hidden" name="en[items][${serviceIndex}][text]" class="d-none"></textarea>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group w-100">
                                        <label class="form-label" for="${imageId}">@lang('dashboard.image')</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input name="en[items][${serviceIndex}][image]" type="hidden" value="file_${fileId}">
                                                <input name="ar[items][${serviceIndex}][image]" type="hidden" value="file_${fileId}">
                                                <input name="file[${fileId}]" type="file" class="custom-file-input" id="${imageId}" accept="image/*">
                                                <label class="custom-file-label" for="${imageId}">@lang('dashboard.choose_file')</label>
                                                <input name="old_file[${fileId}]" type="hidden" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-2">
                                    <img id="imagePreview${fileId}" src="#" alt="Preview" class="img-thumbnail d-none" style="max-height: 100px;">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-1 d-flex align-items-center justify-content-center">
                            <button type="button" class="btn btn-sm btn-danger remove-service" title="@lang('dashboard.delete')">
                                @lang('dashboard.delete')
                            </button>
                        </div>
                    </div>`;
                $('#services-container').append(row);

                $(`#${imageId}`).on('change', function() {
                    var fileName = $(this).val().split('\\').pop();
                    $(this).siblings('.custom-file-label').html(fileName || '@lang('dashboard.choose_file')');
                    if (this.files && this.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $(`#imagePreview${fileId}`).attr('src', e.target.result).removeClass('d-none');
                        };
                        reader.readAsDataURL(this.files[0]);
                    }
                });

                var toolbarOptions = [
                    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                    [{ 'direction': 'rtl' }],
                    [{ 'color': [] }, { 'background': [] }],
                    ['clean'],
                ];

                var arQuillId = 'ar_service_text_' + serviceIndex;
                var arQuill = new Quill('#' + arQuillId, {
                    modules: { toolbar: toolbarOptions },
                    theme: 'snow',
                    placeholder: 'اكتب هنا...'
                });
                arQuill.on('text-change', function() {
                    $('#' + arQuillId + '_hidden').val(arQuill.root.innerHTML);
                });

                var enQuillId = 'en_service_text_' + serviceIndex;
                var enQuill = new Quill('#' + enQuillId, {
                    modules: { toolbar: toolbarOptions },
                    theme: 'snow',
                    placeholder: 'Write here...'
                });
                enQuill.on('text-change', function() {
                    $('#' + enQuillId + '_hidden').val(enQuill.root.innerHTML);
                });

                serviceIndex++;
            });

            $(document).on('click', '.remove-service', function(e) {
                e.preventDefault();
                $(this).closest('.service-row').remove();
            });
        });
    </script>
@endpush
