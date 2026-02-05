<?php

namespace App\Modules\Structure\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class FeaturesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ar.features.*.title' => 'required|string|max:255',
            'en.features.*.title' => 'required|string|max:255',
            'file.*' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ];
    }

    public function attributes(): array
    {
        return [
            'ar.features.*.title' => 'عنوان الميزة (عربي)',
            'en.features.*.title' => 'Feature Title (English)',
            'file.*' => 'الصورة المرفقة',
        ];
    }
}

