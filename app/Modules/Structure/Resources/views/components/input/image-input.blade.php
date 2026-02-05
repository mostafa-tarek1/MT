<div class="row">
    <div class="{{ $wrapperClass }}">
        <div class="form-group w-100">
            @if ($label)
                <label class="form-label" for="{{ $id }}">{{ $label }}</label>
            @endif
            <div class="input-group">
                <div class="custom-file">
                    {{-- Hidden inputs to preserve keys --}}
                    <input name="{{ $enName }}" type="hidden" value="file_{{ $fileId }}">
                    <input name="{{ $arName }}" type="hidden" value="file_{{ $fileId }}">
                    {{-- Actual file upload --}}
                    <input name="file[{{ $fileId }}]" type="file" class="custom-file-input" id="{{ $id }}"
                        accept="{{ $accept }}" {{ $required ? 'required' : '' }}>
                    <label class="custom-file-label" for="{{ $id }}">@lang('dashboard.choose_file')</label>
                    {{-- Old file for fallback --}}
                    <input name="old_file[{{ $fileId }}]" type="hidden"
                        value="{{ old('old_file.' . $fileId, $value) }}">
                </div>
            </div>
        </div>
        @error('file.' . $fileId)
            <div class="text-danger p-2">{{ $message }}</div>
        @enderror
    </div>
    @if ($showPreview)
        <div class="{{ $previewClass }}">
            @php
                $photo = old('old_file.' . $fileId, $value);
            @endphp
            @if ($photo)
                <a href="{{ $photo }}" class="glightbox" data-gallery="{{ $gallery ?? 'gallery' }}">
                    <img id="imagePreview{{ $fileId }}" src="{{ $photo }}" alt="Photo Preview" class="img-thumbnail"
                        style="max-height: {{ $previewMaxHeight }};">
                </a>
            @else
                <img id="imagePreview{{ $fileId }}" src="#" alt="Preview" class="img-thumbnail d-none"
                    style="max-height: {{ $previewMaxHeight }};">
            @endif
        </div>
    @endif
</div>

@push('scripts')
    <script>
        $(document).ready(function () {
            // Update custom file label
            $('#{{ $id }}').on('change', function () {
                var fileName = $(this).val().split('\\').pop();
                $(this).siblings('.custom-file-label').html(fileName || '@lang('dashboard.choose_file')');

                // Preview image
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#imagePreview{{ $fileId }}')
                            .attr('src', e.target.result)
                            .removeClass('d-none');
                    };
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
    </script>
@endpush