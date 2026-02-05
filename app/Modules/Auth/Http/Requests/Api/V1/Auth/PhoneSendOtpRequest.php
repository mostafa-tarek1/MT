<?php

namespace App\Modules\Auth\Http\Requests\Api\V1\Auth;

use Illuminate\Foundation\Http\FormRequest;

class PhoneSendOtpRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'phone' => 'required|string|regex:/^[0-9]{11}$/',
        ];
    }

    public function messages(): array
    {
        return [
            'phone.required' => __('messages.Phone is required'),
            'phone.regex' => __('messages.Phone must be 11 digits'),
        ];
    }
}
