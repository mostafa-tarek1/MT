<?php

namespace App\Modules\Structure\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class WhoIsThisForRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ar.title' => 'required|string|max:255',
            'ar.items.*.text' => 'required|string|max:255',
            'en.title' => 'required|string|max:255',
            'en.items.*.text' => 'required|string|max:255',
            'file.*' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ];
    }

    public function attributes(): array
    {
        return [
            'ar.title' => 'العنوان (عربي)',
            'ar.items.*.text' => 'نص العنصر (عربي)',
            'en.title' => 'Title (English)',
            'en.items.*.text' => 'Item Text (English)',
            'file.*' => 'الصورة المرفقة',
        ];
    }
}

