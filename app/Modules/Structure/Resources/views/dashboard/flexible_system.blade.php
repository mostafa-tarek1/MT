@extends('base::components.dashboard.layouts.master')
@section('title', __('dashboard.Flexible System Section'))

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="users-list-wrapper">
                    <x-breadcrumb.breadcrumb title="{{ __('dashboard.Flexible System Section') }}" :breadcrumbs="[['name' => __('dashboard.Flexible System Section')]]" />
                    <section id="column-selectors">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h4 class="card-title mb-0">{{ __('dashboard.Flexible System Section') }}</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <x-form.form-component :route="route('flexible_system.store')" method="POST" enctype="multipart/form-data">
                                                <x-input.input-field name="ar[title]" id="ar_title"
                                                    placeholder="{{ __('dashboard.Title (AR)') }}"
                                                    label="{{ __('dashboard.Title (AR)') }}" :value="old('ar.title') ?? ($content['ar']['title'] ?? '')" />
                                                <x-input.input-field name="en[title]" id="en_title"
                                                    placeholder="{{ __('dashboard.Title (EN)') }}"
                                                    label="{{ __('dashboard.Title (EN)') }}" :value="old('en.title') ?? ($content['en']['title'] ?? '')" />
                                                
                                                <hr class="my-3 text-muted"/>
                                                <h3 class="text-muted">@lang('dashboard.Cards')</h3>
                                                <div id="cards-container" class="mb-4">
                                                    @foreach (old('ar.cards', data_get($content, 'ar.cards', [])) as $index => $card)
                                                        <div class="row card-row mb-3" data-index="{{ $index }}">
                                                            <div class="col-12 col-md-4">
                                                                <x-input.input-field 
                                                                    name="ar[cards][{{ $index }}][title]" 
                                                                    id="ar_card_title_{{ $index }}"
                                                                    placeholder="{{ __('dashboard.Card Title (AR)') }}"
                                                                    label="{{ __('dashboard.Card Title (AR)') }}"
                                                                    :value="old('ar.cards.' . $index . '.title', $card['title'] ?? '')" />
                                                                <x-editor.quill 
                                                                    id="ar_card_text_{{ $index }}"
                                                                    label="{{ __('dashboard.Card Text (AR)') }}" 
                                                                    name="ar[cards][{{ $index }}][text]"
                                                                    :value="old('ar.cards.' . $index . '.text', $card['text'] ?? '')" />
                                                            </div>
                                                            <div class="col-12 col-md-4">
                                                                <x-input.input-field 
                                                                    name="en[cards][{{ $index }}][title]" 
                                                                    id="en_card_title_{{ $index }}"
                                                                    placeholder="{{ __('dashboard.Card Title (EN)') }}"
                                                                    label="{{ __('dashboard.Card Title (EN)') }}"
                                                                    :value="old('en.cards.' . $index . '.title', data_get($content, 'en.cards.' . $index . '.title', ''))" />
                                                                <x-editor.quill 
                                                                    id="en_card_text_{{ $index }}"
                                                                    label="{{ __('dashboard.Card Text (EN)') }}" 
                                                                    name="en[cards][{{ $index }}][text]"
                                                                    :value="old('en.cards.' . $index . '.text', data_get($content, 'en.cards.' . $index . '.text', ''))" />
                                                            </div>
                                                            <div class="col-12 col-md-3">
                                                                @php
    $fileId = 600 + $index;
    $imageId = 'card_image_' . $fileId;
                                                                @endphp
                                                                <x-input.image-input 
                                                                    name="cards[{{ $index }}][image]"
                                                                    :fileId="$fileId"
                                                                    :id="$imageId"
                                                                    :label="__('dashboard.image')"
                                                                    :value="old('old_file.' . $fileId, $card['image'] ?? '')"
                                                                    wrapperClass="col-12"
                                                                    previewClass="col-12 mt-2"
                                                                    :showPreview="true"
                                                                    previewMaxHeight="100px"
                                                                    enName="en[cards][{{ $index }}][image]"
                                                                    arName="ar[cards][{{ $index }}][image]"
                                                                />
                                                            </div>
                                                            <div class="col-12 col-md-1 d-flex align-items-center justify-content-center">
                                                                <button type="button" class="btn btn-sm btn-danger remove-card" title="{{ __('dashboard.delete') }}">
                                                                    @lang('dashboard.delete')
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <button type="button" class="btn btn-success btn-sm mt-2" id="add_card">
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
                    iziToast.error({
                        title: '',
                        position: 'topLeft',
                        message: "{{ $error }}"
                });                @endforeach
            });
        @endif
    </script>
    <script>
        $(function() {
            let cardIndex = {{ count(old('ar.cards', data_get($content, 'ar.cards', []))) }};

            $('#add_card').on('click', function() {
                const fileId = 600 + cardIndex;
                const imageId = 'card_image_' + fileId;
                const row = `
                    <div class="row card-row mb-3" data-index="${cardIndex}">
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="ar_card_title_${cardIndex}">@lang('dashboard.Card Title (AR)')</label>
                                <input type="text" name="ar[cards][${cardIndex}][title]" id="ar_card_title_${cardIndex}" class="form-control" placeholder="@lang('dashboard.Card Title (AR)')">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="ar_card_text_${cardIndex}">@lang('dashboard.Card Text (AR)')</label>
                                <div id="ar_card_text_${cardIndex}" style="min-height: 200px;"></div>
                                <textarea id="ar_card_text_${cardIndex}_hidden" name="ar[cards][${cardIndex}][text]" class="d-none"></textarea>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="en_card_title_${cardIndex}">@lang('dashboard.Card Title (EN)')</label>
                                <input type="text" name="en[cards][${cardIndex}][title]" id="en_card_title_${cardIndex}" class="form-control" placeholder="@lang('dashboard.Card Title (EN)')">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="en_card_text_${cardIndex}">@lang('dashboard.Card Text (EN)')</label>
                                <div id="en_card_text_${cardIndex}" style="min-height: 200px;"></div>
                                <textarea id="en_card_text_${cardIndex}_hidden" name="en[cards][${cardIndex}][text]" class="d-none"></textarea>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group w-100">
                                        <label class="form-label" for="${imageId}">@lang('dashboard.image')</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input name="en[cards][${cardIndex}][image]" type="hidden" value="file_${fileId}">
                                                <input name="ar[cards][${cardIndex}][image]" type="hidden" value="file_${fileId}">
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
                            <button type="button" class="btn btn-sm btn-danger remove-card" title="@lang('dashboard.delete')">
                                @lang('dashboard.delete')
                            </button>
                        </div>
                    </div>`;
                $('#cards-container').append(row);

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

                // Initialize Quill editors for the new row
                var toolbarOptions = [
                    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                    [{ 'direction': 'rtl' }],
                    [{ 'color': [] }, { 'background': [] }],
                    ['clean'],
                ];

                // Initialize Arabic Quill editor
                var arQuillId = 'ar_card_text_' + cardIndex;
                var arQuill = new Quill('#' + arQuillId, {
                    modules: {
                        toolbar: toolbarOptions
                    },
                    theme: 'snow',
                    placeholder: 'اكتب هنا...'
                });
                arQuill.on('text-change', function () {
                    var html = arQuill.root.innerHTML;
                    $('#' + arQuillId + '_hidden').val(html);
                });

                // Initialize English Quill editor
                var enQuillId = 'en_card_text_' + cardIndex;
                var enQuill = new Quill('#' + enQuillId, {
                    modules: {
                        toolbar: toolbarOptions
                    },
                    theme: 'snow',
                    placeholder: 'Write here...'
                });
                enQuill.on('text-change', function () {
                    var html = enQuill.root.innerHTML;
                    $('#' + enQuillId + '_hidden').val(html);
                });

                cardIndex++;
            });

            $(document).on('click', '.remove-card', function(e) {
                e.preventDefault();
                e.stopPropagation();
                $(this).closest('.card-row').remove();
            });
        });
    </script>
@endpush

