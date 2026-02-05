<?php

namespace App\Modules\Auth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BanUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required_without:phone', 'integer', 'exists:users,id'],
            'phone' => ['required_without:user_id', 'string', 'exists:users,phone'],
            'reason' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required_without' => __('validation.required', ['attribute' => __('dashboard.user_id')]),
            'user_id.exists' => __('validation.exists', ['attribute' => __('dashboard.user_id')]),
            'phone.required_without' => __('validation.required', ['attribute' => __('dashboard.phone')]),
            'phone.exists' => __('validation.exists', ['attribute' => __('dashboard.phone')]),
            'reason.max' => __('validation.max.string', ['attribute' => __('dashboard.ban_reason'), 'max' => 500]),
        ];
    }
}
