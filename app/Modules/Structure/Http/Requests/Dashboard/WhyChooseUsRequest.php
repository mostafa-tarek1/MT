<?php

namespace App\Modules\Structure\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class WhyChooseUsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ar.badge_text' => 'nullable|string|max:255',
            'en.badge_text' => 'nullable|string|max:255',
            'ar.title' => 'nullable|string|max:255',
            'en.title' => 'nullable|string|max:255',
            'ar.description' => 'nullable|string',
            'en.description' => 'nullable|string',
            'ar.items' => 'nullable|array',
            'en.items' => 'nullable|array',
            'file.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ];
    }
}
