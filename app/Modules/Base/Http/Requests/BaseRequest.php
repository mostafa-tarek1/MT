<?php

namespace App\Modules\Base\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'name' => __('validation.attributes.name'),
            'email' => __('validation.attributes.email'),
            'password' => __('validation.attributes.password'),
            'phone' => __('validation.attributes.phone'),
            'title' => __('validation.attributes.title'),
            'description' => __('validation.attributes.description'),
            'price' => __('validation.attributes.price'),
            'quantity' => __('validation.attributes.quantity'),
            'status' => __('validation.attributes.status'),
            'is_active' => __('validation.attributes.is_active'),
            'image' => __('validation.attributes.image'),
            'file' => __('validation.attributes.file'),
            'category_id' => __('validation.attributes.category'),
            'user_id' => __('validation.attributes.user'),
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'required' => __('validation.required'),
            'string' => __('validation.string'),
            'email' => __('validation.email'),
            'unique' => __('validation.unique'),
            'exists' => __('validation.exists'),
            'min' => __('validation.min.string'),
            'max' => __('validation.max.string'),
            'numeric' => __('validation.numeric'),
            'integer' => __('validation.integer'),
            'boolean' => __('validation.boolean'),
            'array' => __('validation.array'),
            'date' => __('validation.date'),
            'image' => __('validation.image'),
            'mimes' => __('validation.mimes'),
            'max_file' => __('validation.max.file'),
            'confirmed' => __('validation.confirmed'),
            'in' => __('validation.in'),
            'between' => __('validation.between.numeric'),
        ];
    }
}
