<?php

namespace App\Modules\Structure\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CTARequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ar.title' => 'required|string|max:255',
            'ar.button_text' => 'required|string|max:255',
            'en.title' => 'required|string|max:255',
            'en.button_text' => 'required|string|max:255',
        ];
    }

    public function attributes(): array
    {
        return [
            'ar.title' => 'العنوان (عربي)',
            'ar.button_text' => 'نص الزر (عربي)',
            'en.title' => 'Title (English)',
            'en.button_text' => 'Button Text (English)',
        ];
    }
}

