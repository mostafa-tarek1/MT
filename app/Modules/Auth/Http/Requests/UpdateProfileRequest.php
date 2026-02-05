<?php

namespace App\Modules\Auth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'name' => ['sometimes', 'string', 'max:255'],
            'email' => ['sometimes', 'email', 'max:255', 'unique:users,email,'.$this->user()->id],
            'bio_ar' => ['sometimes', 'nullable', 'string', 'max:1000'],
            'bio_en' => ['sometimes', 'nullable', 'string', 'max:1000'],
            'external_links' => ['sometimes', 'nullable', 'array'],
            'external_links.*' => ['url'],
        ];
    }

    /**
     * Get custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => __('validation.required', ['attribute' => __('auth.name')]),
            'email.email' => __('validation.email', ['attribute' => __('auth.email')]),
            'email.unique' => __('validation.unique', ['attribute' => __('auth.email')]),
            'bio_ar.max' => __('validation.max.string', ['attribute' => __('auth.bio'), 'max' => 1000]),
            'bio_en.max' => __('validation.max.string', ['attribute' => __('auth.bio'), 'max' => 1000]),
        ];
    }
}
