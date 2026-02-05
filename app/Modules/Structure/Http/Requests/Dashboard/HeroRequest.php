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
        $rules = [
            'ar.title_primary' => 'required|string|max:255',
            'ar.title_accent' => 'nullable|string|max:255',
            'ar.subtitle' => 'required|string',
            'ar.button_text' => 'required|string|max:255',
            'ar.button_link' => 'nullable|url|max:500',
            'en.title_primary' => 'required|string|max:255',
            'en.title_accent' => 'nullable|string|max:255',
            'en.subtitle' => 'required|string',
            'en.button_text' => 'required|string|max:255',
            'en.button_link' => 'nullable|url|max:500',
            'file.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ];

        // Add validation for client logos (using file array structure)
        $clientLogos = old('all.client_logos', $this->input('en.client_logos', []));
        if (is_array($clientLogos) && count($clientLogos) > 0) {
            foreach ($clientLogos as $index => $logo) {
                $fileId = 1000 + $index;
                $oldFile = $this->input("old_file.{$fileId}");
                
                if (empty($oldFile)) {
                    $rules["file.{$fileId}"] = 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048';
                } else {
                    $rules["file.{$fileId}"] = 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048';
                }
            }
        }

        return $rules;
    }

    public function attributes(): array
    {
        return [
            'ar.title_primary' => 'العنوان الرئيسي (عربي)',
            'ar.title_accent' => 'العنوان المميز (عربي)',
            'ar.subtitle' => 'العنوان الفرعي (عربي)',
            'ar.button_text' => 'نص الزر (عربي)',
            'ar.button_link' => 'رابط الزر (عربي)',
            'en.title_primary' => 'Title Primary (English)',
            'en.title_accent' => 'Title Accent (English)',
            'en.subtitle' => 'Subtitle (English)',
            'en.button_text' => 'Button Text (English)',
            'en.button_link' => 'Button Link (English)',
            'file.*' => 'الصورة المرفقة',
            'client_logos.*' => 'شعار العميل',
        ];
    }
}

