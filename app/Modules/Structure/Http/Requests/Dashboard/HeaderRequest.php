<?php

namespace App\Modules\Structure\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class HeaderRequest extends FormRequest
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
            'ar.cta_text' => 'nullable|string|max:255',
            'en.cta_text' => 'nullable|string|max:255',
            'ar.nav_items' => 'nullable|array',
            'en.nav_items' => 'nullable|array',
        ];
    }
}
