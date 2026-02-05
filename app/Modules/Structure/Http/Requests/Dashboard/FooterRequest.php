<?php

namespace App\Modules\Structure\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class FooterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ar.brand_text' => 'nullable|string|max:255',
            'en.brand_text' => 'nullable|string|max:255',
            'ar.description' => 'nullable|string',
            'en.description' => 'nullable|string',
            'ar.quick_links' => 'nullable|array',
            'en.quick_links' => 'nullable|array',
            'ar.services_links' => 'nullable|array',
            'en.services_links' => 'nullable|array',
            'all.address' => 'nullable|string|max:255',
            'all.phone' => 'nullable|string|max:255',
            'all.email' => 'nullable|string|max:255',
            'ar.copyright' => 'nullable|string|max:255',
            'en.copyright' => 'nullable|string|max:255',
        ];
    }
}
