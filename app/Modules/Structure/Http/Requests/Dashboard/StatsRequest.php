<?php

namespace App\Modules\Structure\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class StatsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ar.title' => 'nullable|string|max:255',
            'en.title' => 'nullable|string|max:255',
            'ar.subtitle' => 'nullable|string',
            'en.subtitle' => 'nullable|string',
            'ar.items' => 'nullable|array',
            'en.items' => 'nullable|array',
        ];
    }
}
