<?php

namespace App\Modules\Structure\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class QuoteModalRequest extends FormRequest
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
            'ar.name_label' => 'nullable|string|max:255',
            'en.name_label' => 'nullable|string|max:255',
            'ar.phone_label' => 'nullable|string|max:255',
            'en.phone_label' => 'nullable|string|max:255',
            'ar.products_label' => 'nullable|string|max:255',
            'en.products_label' => 'nullable|string|max:255',
            'ar.add_product_text' => 'nullable|string|max:255',
            'en.add_product_text' => 'nullable|string|max:255',
            'ar.submit_text' => 'nullable|string|max:255',
            'en.submit_text' => 'nullable|string|max:255',
            'ar.cancel_text' => 'nullable|string|max:255',
            'en.cancel_text' => 'nullable|string|max:255',
        ];
    }
}
