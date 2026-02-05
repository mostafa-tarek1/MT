<?php

namespace App\Modules\Auth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadProfileImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }

    /**
     * Get custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'image.required' => __('validation.required', ['attribute' => __('auth.image')]),
            'image.image' => __('validation.image', ['attribute' => __('auth.image')]),
            'image.mimes' => __('validation.mimes', ['attribute' => __('auth.image')]),
            'image.max' => __('validation.max.file', ['attribute' => __('auth.image'), 'max' => 2048]),
        ];
    }
}
