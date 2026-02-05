@extends('base::components.dashboard.layouts.master')
@section('title', __('dashboard.customer_reviews'))

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row"></div>
            <div class="content-body">
                <section class="users-list-wrapper">
                    <x-breadcrumb.breadcrumb title="{{ __('dashboard.customer_reviews') }}" :breadcrumbs="[['name' => __('dashboard.customer_reviews')]]" />
                    <section id="column-selectors">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h4 class="card-title mb-0">{{ __('dashboard.customer_reviews') }}</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <x-form.form-component :route="route('customer_reviews.store')" method="POST" enctype="multipart/form-data">
                                                <h3 class="text-muted">@lang('dashboard.customer_reviews')</h3>
                                                <x-input.input-field name="ar[main_title]" id="ar_main_title"
                                                    placeholder="{{ __('dashboard.main_title (AR)') }}" label="{{ __('dashboard.main_title (AR)') }}"
                                                    :value="old('ar.main_title') ?? ($content['ar']['main_title'] ?? '')" />
                                                <x-input.input-field name="en[main_title]" id="en_main_title"
                                                    placeholder="{{ __('dashboard.main_title (EN)') }}" label="{{ __('dashboard.main_title (EN)') }}"
                                                    :value="old('en.main_title') ?? ($content['en']['main_title'] ?? '')" />
                                                <hr class="my-3 text-muted"/>
                                                <h3 class="text-muted">@lang('dashboard.customer_reviews')</h3>
                                                <div id="reviews-container" class="mb-4">
                                                    @foreach (old('ar.reviews', data_get($content, 'ar.reviews', [])) as $index => $review)
                                                        <div class="row review-row mb-3" data-index="{{ $index }}">
                                                            <div class="col-12 col-md-3">
                                                                @php
    $fileId = 500 + $index;
    $imageId = 'review_image_' . $fileId;
                                                                @endphp
                                                                <x-input.image-input 
                                                                    name="reviews[{{ $index }}][image]"
                                                                    :fileId="$fileId"
                                                                    :id="$imageId"
                                                                    :label="__('dashboard.image')"
                                                                    :value="old('old_file.' . $fileId, $review['image'] ?? '')"
                                                                    wrapperClass="col-12"
                                                                    previewClass="col-12 mt-2"
                                                                    :showPreview="true"
                                                                    previewMaxHeight="100px"
                                                                    enName="en[reviews][{{ $index }}][image]"
                                                                    arName="ar[reviews][{{ $index }}][image]"
                                                                />
                                                            </div>
                                                            <div class="col-12 col-md-4">
                                                                <x-input.input-field 
                                                                    name="ar[reviews][{{ $index }}][name]" 
                                                                    id="ar_review_name_{{ $index }}"
                                                                    placeholder="{{ __('dashboard.Name (AR)') }}"
                                                                    label="{{ __('dashboard.Name (AR)') }}"
                                                                    :value="old('ar.reviews.' . $index . '.name', $review['name'] ?? '')" />
                                                                <x-input.input-field 
                                                                    name="en[reviews][{{ $index }}][name]" 
                                                                    id="en_review_name_{{ $index }}"
                                                                    placeholder="{{ __('dashboard.Name (EN)') }}"
                                                                    label="{{ __('dashboard.Name (EN)') }}"
                                                                    :value="old('en.reviews.' . $index . '.name', data_get($content, 'en.reviews.' . $index . '.name', ''))" />
                                                                <x-input.input-field 
                                                                    name="ar[reviews][{{ $index }}][job]" 
                                                                    id="ar_review_job_{{ $index }}"
                                                                    placeholder="{{ __('dashboard.Job (AR)') }}"
                                                                    label="{{ __('dashboard.Job (AR)') }}"
                                                                    :value="old('ar.reviews.' . $index . '.job', $review['job'] ?? '')" />
                                                                <x-input.input-field 
                                                                    name="en[reviews][{{ $index }}][job]" 
                                                                    id="en_review_job_{{ $index }}"
                                                                    placeholder="{{ __('dashboard.Job (EN)') }}"
                                                                    label="{{ __('dashboard.Job (EN)') }}"
                                                                    :value="old('en.reviews.' . $index . '.job', data_get($content, 'en.reviews.' . $index . '.job', ''))" />
                                                            </div>
                                                            <div class="col-12 col-md-4">
                                                                <x-editor.quill 
                                                                    id="ar_review_text_{{ $index }}"
                                                                    label="{{ __('dashboard.Text (AR)') }}" 
                                                                    name="ar[reviews][{{ $index }}][text]"
                                                                    :value="old('ar.reviews.' . $index . '.text', $review['text'] ?? '')" />
                                                                <x-editor.quill 
                                                                    id="en_review_text_{{ $index }}"
                                                                    label="{{ __('dashboard.Text (EN)') }}" 
                                                                    name="en[reviews][{{ $index }}][text]"
                                                                    :value="old('en.reviews.' . $index . '.text', data_get($content, 'en.reviews.' . $index . '.text', ''))" />
                                                            </div>
                                                            <div class="col-12 col-md-1 d-flex align-items-center justify-content-center">
                                                                <button type="button" class="btn btn-sm btn-danger remove-review" title="{{ __('dashboard.delete') }}">
                                                                    @lang('dashboard.delete')
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <button type="button" class="btn btn-success btn-sm mt-2 col-lg-2" id="add_review">
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
                });            @endforeach
            });
        @endif
    </script>
    <script>
        $(function() {
            let reviewIndex = {{ count(old('ar.reviews', data_get($content, 'ar.reviews', []))) }};

            // Add review
            $('#add_review').on('click', function() {
                const fileId = 500 + reviewIndex;
                const imageId = 'review_image_' + fileId;
                const row = `
                    <div class="row review-row mb-3" data-index="${reviewIndex}">
                        <div class="col-12 col-md-3">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group w-100">
                                        <label class="form-label" for="${imageId}">@lang('dashboard.image')</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input name="en[reviews][${reviewIndex}][image]" type="hidden" value="file_${fileId}">
                                                <input name="ar[reviews][${reviewIndex}][image]" type="hidden" value="file_${fileId}">
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
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="ar_review_name_${reviewIndex}">@lang('dashboard.Name (AR)')</label>
                                <input type="text" name="ar[reviews][${reviewIndex}][name]" id="ar_review_name_${reviewIndex}" class="form-control" placeholder="@lang('dashboard.Name (AR)')">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="en_review_name_${reviewIndex}">@lang('dashboard.Name (EN)')</label>
                                <input type="text" name="en[reviews][${reviewIndex}][name]" id="en_review_name_${reviewIndex}" class="form-control" placeholder="@lang('dashboard.Name (EN)')">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="ar_review_job_${reviewIndex}">@lang('dashboard.Job (AR)')</label>
                                <input type="text" name="ar[reviews][${reviewIndex}][job]" id="ar_review_job_${reviewIndex}" class="form-control" placeholder="@lang('dashboard.Job (AR)')">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="en_review_job_${reviewIndex}">@lang('dashboard.Job (EN)')</label>
                                <input type="text" name="en[reviews][${reviewIndex}][job]" id="en_review_job_${reviewIndex}" class="form-control" placeholder="@lang('dashboard.Job (EN)')">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="ar_review_text_${reviewIndex}">@lang('dashboard.Text (AR)')</label>
                                <div id="ar_review_text_${reviewIndex}" style="min-height: 200px;"></div>
                                <textarea id="ar_review_text_${reviewIndex}_hidden" name="ar[reviews][${reviewIndex}][text]" class="d-none"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="en_review_text_${reviewIndex}">@lang('dashboard.Text (EN)')</label>
                                <div id="en_review_text_${reviewIndex}" style="min-height: 200px;"></div>
                                <textarea id="en_review_text_${reviewIndex}_hidden" name="en[reviews][${reviewIndex}][text]" class="d-none"></textarea>
                            </div>
                        </div>
                        <div class="col-12 col-md-1 d-flex align-items-center justify-content-center">
                            <button type="button" class="btn btn-sm btn-danger remove-review" title="@lang('dashboard.delete')">
                                @lang('dashboard.delete')
                            </button>
                        </div>
                    </div>`;
                $('#reviews-container').append(row);

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
                var arQuillId = 'ar_review_text_' + reviewIndex;
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
                var enQuillId = 'en_review_text_' + reviewIndex;
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

                reviewIndex++;
            });

            $(document).on('click', '.remove-review', function(e) {
                e.preventDefault();
                e.stopPropagation();
                $(this).closest('.review-row').remove();
            });
        });
    </script>
@endpush
