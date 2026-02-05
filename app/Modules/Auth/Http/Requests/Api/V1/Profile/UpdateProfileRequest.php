<?php

namespace App\Modules\Auth\Http\Requests\Api\V1\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = auth()->id();

        return [
            'name' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'size:11', Rule::unique('users', 'phone')->ignore($userId)],
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,jpg,png,gif', 'max:2048'], // max 2MB
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.string' => __('validation.string', ['attribute' => __('auth.name')]),
            'name.max' => __('validation.max.string', ['attribute' => __('auth.name'), 'max' => 255]),
            'phone.string' => __('validation.string', ['attribute' => __('auth.phone')]),
            'phone.size' => __('validation.size.string', ['attribute' => __('auth.phone'), 'size' => 11]),
            'phone.unique' => __('messages.Phone already exists'),
            'profile_image.image' => __('validation.image', ['attribute' => __('auth.profile_image')]),
            'profile_image.mimes' => __('validation.mimes', ['attribute' => __('auth.profile_image'), 'values' => 'jpeg, jpg, png, gif']),
            'profile_image.max' => __('validation.max.file', ['attribute' => __('auth.profile_image'), 'max' => 2048]),
        ];
    }
}
