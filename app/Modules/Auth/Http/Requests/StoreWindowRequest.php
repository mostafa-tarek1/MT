<?php

namespace App\Modules\Auth\Http\Requests;

use App\Modules\Auth\Models\StoreWindow;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreWindowRequest extends FormRequest
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
            'id' => ['sometimes', 'integer', 'exists:store_windows,id'],
            'window_type' => ['required', Rule::in(StoreWindow::getWindowTypes())],
            'title_ar' => ['required', 'string', 'max:100'],
            'title_en' => ['sometimes', 'nullable', 'string', 'max:100'],
            'content_ar' => ['required', 'string', 'max:4000'],
            'content_en' => ['sometimes', 'nullable', 'string', 'max:4000'],
            'images' => ['sometimes', 'nullable', 'array', 'max:5'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'order' => ['sometimes', 'integer', 'min:0'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }

    /**
     * Get custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'window_type.required' => __('validation.required', ['attribute' => __('auth.window_type')]),
            'window_type.in' => __('validation.in', ['attribute' => __('auth.window_type')]),
            'title_ar.required' => __('validation.required', ['attribute' => __('auth.title')]),
            'title_ar.max' => __('validation.max.string', ['attribute' => __('auth.title'), 'max' => 100]),
            'title_en.max' => __('validation.max.string', ['attribute' => __('auth.title'), 'max' => 100]),
            'content_ar.required' => __('validation.required', ['attribute' => __('auth.content')]),
            'content_ar.max' => __('validation.max.string', ['attribute' => __('auth.content'), 'max' => 4000]),
            'images.max' => __('validation.max.array', ['attribute' => __('auth.images'), 'max' => 5]),
        ];
    }
}
