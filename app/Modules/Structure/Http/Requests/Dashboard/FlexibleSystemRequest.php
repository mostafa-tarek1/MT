<?php

namespace App\Modules\Structure\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class FlexibleSystemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ar.title' => 'required|string|max:255',
            'ar.cards.*.title' => 'required|string|max:255',
            'ar.cards.*.text' => 'required|string',
            'en.title' => 'required|string|max:255',
            'en.cards.*.title' => 'required|string|max:255',
            'en.cards.*.text' => 'required|string',
            'file.*' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ];
    }

    public function attributes(): array
    {
        return [
            'ar.title' => 'العنوان (عربي)',
            'ar.cards.*.title' => 'عنوان البطاقة (عربي)',
            'ar.cards.*.text' => 'نص البطاقة (عربي)',
            'en.title' => 'Title (English)',
            'en.cards.*.title' => 'Card Title (English)',
            'en.cards.*.text' => 'Card Text (English)',
            'file.*' => 'الصورة المرفقة',
        ];
    }
}

