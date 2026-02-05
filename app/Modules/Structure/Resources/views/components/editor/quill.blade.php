@section('styles')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboardAssets/app-assets/vendors/css/editors/quill/quill.snow.css') }}">
    <style>
        .ql-toolbar.ql-snow {
            border: 1px solid #d8d6de;
            border-radius: 0.357rem 0.357rem 0 0;
            box-sizing: border-box;
            font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif;
            padding: 8px;
        }

        .ql-container.ql-snow {
            border: 1px solid #d8d6de;
            border-top: none;
            border-radius: 0 0 0.357rem 0.357rem;
            font-size: 14px;
        }

        .ql-editor {
            min-height: 200px;

        }

        @if(app()->getLocale() === 'ar')
            .ql-editor {
                direction: rtl;
                text-align: right;
            }

        @endif .ql-editor.ql-blank::before {
            font-style: normal;
            color: #b4b7bd;
        }

        .ql-snow .ql-toolbar button {
            margin: 0 1px;
            padding: 3px 5px;
        }

        .ql-snow .ql-toolbar button+button {
            margin-left: 0;
        }

        .ql-snow .ql-picker {
            margin: 0 2px;
        }

        .ql-snow .ql-toolbar .ql-formats {
            margin-right: 8px;
        }

        .ql-snow .ql-toolbar .ql-formats:last-child {
            margin-right: 0;
        }
    </style>
@endsection

@push('scripts')
    <script src="{{ asset('dashboardAssets/app-assets/vendors/js/editors/quill/quill.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            var toolbarOptions = [
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                [{ 'direction': 'rtl' }],
                [{ 'color': [] }, { 'background': [] }],
                ['clean'],

            ];

            var quill = new Quill('#{{ $id }}', {
                modules: {
                    toolbar: toolbarOptions
                },
                theme: 'snow',
                placeholder: "{{ app()->getLocale() === 'ar' ? 'اكتب هنا...' : 'Write here...' }}"
            });


            // Set initial content
            @if(!empty($value))
                quill.root.innerHTML = {!! json_encode($value) !!};
            @endif

            // Update textarea on text change
            quill.on('text-change', function () {
                var html = quill.root.innerHTML;
                $('#{{ $id }}_hidden').val(html);
            });

            // Set initial value if exists
            @if(!empty(old($name, $value)))
                var initialContent = {!! json_encode(old($name, $value)) !!};
                quill.root.innerHTML = initialContent;
                $('#{{ $id }}_hidden').val(initialContent);
            @endif
                                            });
    </script>
@endpush

<div class="col-md-12 mb-3">
    <label class="form-label" for="{{ $id }}">@lang($label)</label>
    <div id="{{ $id }}" style="min-height: 200px;"></div>
    <textarea id="{{ $id }}_hidden" name="{{ $name }}" class="d-none">{!! old($name, $value) !!}</textarea>
    @error($name)
        <div class="text-danger p-2">{{ $message }}</div>
    @enderror
</div>