<?php

namespace App\Modules\Auth\Http\Requests\Api\V1\Auth;

use Illuminate\Foundation\Http\FormRequest;

class PhoneVerifyOtpRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'phone' => 'required|string|regex:/^[0-9]{11}$/',
            'code' => 'required|string|min:4|max:6',
            'name' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'phone.required' => __('messages.Phone is required'),
            'phone.regex' => __('messages.Phone must be 11 digits'),
            'code.required' => __('messages.OTP code is required'),
            'code.size' => __('messages.OTP code must be 6 digits'),
            'name.max' => __('messages.Name is too long'),
        ];
    }
}
