<?php

namespace App\Modules\Structure\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class HeroRequest extends FormRequest
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
        return [
            'ar.title' => 'nullable|string|max:255',
            'en.title' => 'nullable|string|max:255',
            'ar.highlight' => 'nullable|string|max:255',
            'en.highlight' => 'nullable|string|max:255',
            'ar.description' => 'nullable|string',
            'en.description' => 'nullable|string',
            'ar.primary_button_text' => 'nullable|string|max:255',
            'en.primary_button_text' => 'nullable|string|max:255',
            'ar.primary_button_link' => 'nullable|url|max:500',
            'en.primary_button_link' => 'nullable|url|max:500',
            'ar.secondary_button_text' => 'nullable|string|max:255',
            'en.secondary_button_text' => 'nullable|string|max:255',
            'ar.secondary_button_link' => 'nullable|url|max:500',
            'en.secondary_button_link' => 'nullable|url|max:500',
            'file.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ];
    }

    public function attributes(): array
    {
        return [
            'ar.title' => 'العنوان (عربي)',
            'ar.highlight' => 'العنوان المميز (عربي)',
            'ar.description' => 'الوصف (عربي)',
            'ar.primary_button_text' => 'نص الزر الأساسي (عربي)',
            'ar.primary_button_link' => 'رابط الزر الأساسي (عربي)',
            'ar.secondary_button_text' => 'نص الزر الثانوي (عربي)',
            'ar.secondary_button_link' => 'رابط الزر الثانوي (عربي)',
            'en.title' => 'Title (English)',
            'en.highlight' => 'Highlight (English)',
            'en.description' => 'Description (English)',
            'en.primary_button_text' => 'Primary Button Text (English)',
            'en.primary_button_link' => 'Primary Button Link (English)',
            'en.secondary_button_text' => 'Secondary Button Text (English)',
            'en.secondary_button_link' => 'Secondary Button Link (English)',
            'file.*' => 'الصورة المرفقة',
        ];
    }
}

