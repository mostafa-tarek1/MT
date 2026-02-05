<?php

namespace App\Modules\Auth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStoreLocationRequest extends FormRequest
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
            'lat' => ['required', 'numeric', 'between:-90,90'],
            'lng' => ['required', 'numeric', 'between:-180,180'],
        ];
    }

    /**
     * Get custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'lat.required' => __('validation.required', ['attribute' => __('auth.latitude')]),
            'lat.numeric' => __('validation.numeric', ['attribute' => __('auth.latitude')]),
            'lat.between' => __('validation.between.numeric', ['attribute' => __('auth.latitude'), 'min' => -90, 'max' => 90]),
            'lng.required' => __('validation.required', ['attribute' => __('auth.longitude')]),
            'lng.numeric' => __('validation.numeric', ['attribute' => __('auth.longitude')]),
            'lng.between' => __('validation.between.numeric', ['attribute' => __('auth.longitude'), 'min' => -180, 'max' => 180]),
        ];
    }
}
