@extends('base::components.dashboard.layouts.master')
@section('title', __('dashboard.Why Choose Us Section'))

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row"></div>
            <div class="content-body">
                <section class="users-list-wrapper">
                    <x-breadcrumb.breadcrumb title="{{ __('dashboard.Why Choose Us Section') }}"
                        :breadcrumbs="[['name' => __('dashboard.Why Choose Us Section')]]" />
                    <section id="column-selectors">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h4 class="card-title mb-0">{{ __('dashboard.Why Choose Us Section') }}</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <x-form.form-component :route="route('why_choose_us.store')" method="POST"
                                                enctype="multipart/form-data">
                                                <div class="row">
                                                    <x-input.input-field name="ar[badge_text]" id="ar_badge_text"
                                                        placeholder="{{ __('dashboard.Badge Text (AR)') }}"
                                                        label="{{ __('dashboard.Badge Text (AR)') }}"
                                                        :value="old('ar.badge_text') ?? ($content['ar']['badge_text'] ?? '')" />
                                                    <x-input.input-field name="en[badge_text]" id="en_badge_text"
                                                        placeholder="{{ __('dashboard.Badge Text (EN)') }}"
                                                        label="{{ __('dashboard.Badge Text (EN)') }}"
                                                        :value="old('en.badge_text') ?? ($content['en']['badge_text'] ?? '')" />
                                                </div>
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
                                                    @php
                                                        $fileId = 300;
                                                        $imageId = 'why_choose_image_' . $fileId;
                                                    @endphp
                                                    <x-input.image-input name="image" :fileId="$fileId" :id="$imageId"
                                                        :label="__('dashboard.image')"
                                                        :value="old('old_file.' . $fileId, $content['ar']['image'] ?? '')"
                                                        wrapperClass="col-md-6" previewClass="col-md-6"
                                                        :showPreview="true" previewMaxHeight="200px"
                                                        enName="en[image]" arName="ar[image]" />
                                                </div>

                                                <hr class="my-3 text-muted" />
                                                <h3 class="text-muted">@lang('dashboard.Items')</h3>
                                                <div id="why-items-container" class="mb-4">
                                                    @foreach (old('ar.items', data_get($content, 'ar.items', [])) as $index => $item)
                                                        <div class="row why-item-row mb-3" data-index="{{ $index }}">
                                                            <div class="col-12 col-md-5">
                                                                <x-input.input-field
                                                                    name="ar[items][{{ $index }}][title]"
                                                                    id="ar_why_title_{{ $index }}"
                                                                    placeholder="{{ __('dashboard.Item Title (AR)') }}"
                                                                    label="{{ __('dashboard.Item Title (AR)') }}"
                                                                    :value="old('ar.items.' . $index . '.title', $item['title'] ?? '')" />
                                                                <x-editor.quill id="ar_why_text_{{ $index }}"
                                                                    label="{{ __('dashboard.Item Text (AR)') }}"
                                                                    name="ar[items][{{ $index }}][text]"
                                                                    :value="old('ar.items.' . $index . '.text', $item['text'] ?? '')" />
                                                            </div>
                                                            <div class="col-12 col-md-5">
                                                                <x-input.input-field
                                                                    name="en[items][{{ $index }}][title]"
                                                                    id="en_why_title_{{ $index }}"
                                                                    placeholder="{{ __('dashboard.Item Title (EN)') }}"
                                                                    label="{{ __('dashboard.Item Title (EN)') }}"
                                                                    :value="old('en.items.' . $index . '.title', data_get($content, 'en.items.' . $index . '.title', ''))" />
                                                                <x-editor.quill id="en_why_text_{{ $index }}"
                                                                    label="{{ __('dashboard.Item Text (EN)') }}"
                                                                    name="en[items][{{ $index }}][text]"
                                                                    :value="old('en.items.' . $index . '.text', data_get($content, 'en.items.' . $index . '.text', ''))" />
                                                            </div>
                                                            <div class="col-12 col-md-2 d-flex align-items-center justify-content-center">
                                                                <button type="button" class="btn btn-sm btn-danger remove-why-item"
                                                                    title="{{ __('dashboard.delete') }}">
                                                                    @lang('dashboard.delete')
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <button type="button" class="btn btn-success btn-sm mt-2" id="add_why_item">
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
            let itemIndex = {{ count(old('ar.items', data_get($content, 'ar.items', []))) }};

            $('#add_why_item').on('click', function() {
                const row = `
                    <div class="row why-item-row mb-3" data-index="${itemIndex}">
                        <div class="col-12 col-md-5">
                            <div class="form-group">
                                <label class="form-label" for="ar_why_title_${itemIndex}">@lang('dashboard.Item Title (AR)')</label>
                                <input type="text" name="ar[items][${itemIndex}][title]" id="ar_why_title_${itemIndex}" class="form-control" placeholder="@lang('dashboard.Item Title (AR)')">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="ar_why_text_${itemIndex}">@lang('dashboard.Item Text (AR)')</label>
                                <div id="ar_why_text_${itemIndex}" style="min-height: 200px;"></div>
                                <textarea id="ar_why_text_${itemIndex}_hidden" name="ar[items][${itemIndex}][text]" class="d-none"></textarea>
                            </div>
                        </div>
                        <div class="col-12 col-md-5">
                            <div class="form-group">
                                <label class="form-label" for="en_why_title_${itemIndex}">@lang('dashboard.Item Title (EN)')</label>
                                <input type="text" name="en[items][${itemIndex}][title]" id="en_why_title_${itemIndex}" class="form-control" placeholder="@lang('dashboard.Item Title (EN)')">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="en_why_text_${itemIndex}">@lang('dashboard.Item Text (EN)')</label>
                                <div id="en_why_text_${itemIndex}" style="min-height: 200px;"></div>
                                <textarea id="en_why_text_${itemIndex}_hidden" name="en[items][${itemIndex}][text]" class="d-none"></textarea>
                            </div>
                        </div>
                        <div class="col-12 col-md-2 d-flex align-items-center justify-content-center">
                            <button type="button" class="btn btn-sm btn-danger remove-why-item" title="@lang('dashboard.delete')">
                                @lang('dashboard.delete')
                            </button>
                        </div>
                    </div>`;
                $('#why-items-container').append(row);

                var toolbarOptions = [
                    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                    [{ 'direction': 'rtl' }],
                    [{ 'color': [] }, { 'background': [] }],
                    ['clean'],
                ];

                var arQuillId = 'ar_why_text_' + itemIndex;
                var arQuill = new Quill('#' + arQuillId, {
                    modules: { toolbar: toolbarOptions },
                    theme: 'snow',
                    placeholder: 'اكتب هنا...'
                });
                arQuill.on('text-change', function() {
                    $('#' + arQuillId + '_hidden').val(arQuill.root.innerHTML);
                });

                var enQuillId = 'en_why_text_' + itemIndex;
                var enQuill = new Quill('#' + enQuillId, {
                    modules: { toolbar: toolbarOptions },
                    theme: 'snow',
                    placeholder: 'Write here...'
                });
                enQuill.on('text-change', function() {
                    $('#' + enQuillId + '_hidden').val(enQuill.root.innerHTML);
                });

                itemIndex++;
            });

            $(document).on('click', '.remove-why-item', function(e) {
                e.preventDefault();
                $(this).closest('.why-item-row').remove();
            });
        });
    </script>
@endpush
