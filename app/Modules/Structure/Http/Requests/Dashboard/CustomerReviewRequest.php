<?php

namespace App\Modules\Structure\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CustomerReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'ar.main_title' => ['required', 'string', 'max:255'],
            'en.main_title' => ['required', 'string', 'max:255'],
            'ar.reviews' => ['required', 'array', 'min:1'],
            'en.reviews' => ['required', 'array', 'min:1'],
            
            'ar.reviews.*.name' => ['required', 'string', 'max:255'],
            'en.reviews.*.name' => ['required', 'string', 'max:255'],
            'ar.reviews.*.job' => ['required', 'string', 'max:255'],
            'en.reviews.*.job' => ['required', 'string', 'max:255'],
            'ar.reviews.*.text' => ['required', 'string'],
            'en.reviews.*.text' => ['required', 'string'],
            'ar.reviews.*.image' => ['required', 'string'],
            'en.reviews.*.image' => ['required', 'string'],
        ];

        // Validate image files for reviews
        $reviews = $this->input('ar.reviews', []);
        foreach ($reviews as $index => $review) {
            $fileKey = 'file.'.(500 + $index);
            $oldFile = $this->input('old_file.'.(500 + $index));

            if (empty($oldFile)) {
                $rules[$fileKey] = ['required', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'];
            } else {
                $rules[$fileKey] = ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'];
            }
        }

        return $rules;
    }

    public function attributes(): array
    {
        return [
            'ar.main_title' => 'العنوان الرئيسي (عربي)',
            'en.main_title' => 'Main Title (English)',
            'ar.reviews' => 'المراجعات (عربي)',
            'en.reviews' => 'Reviews (English)',
            'ar.reviews.*.name' => 'اسم المراجع (عربي)',
            'en.reviews.*.name' => 'Reviewer Name (English)',
            'ar.reviews.*.job' => 'وظيفة المراجع (عربي)',
            'en.reviews.*.job' => 'Reviewer Job (English)',
            'ar.reviews.*.text' => 'نص المراجعة (عربي)',
            'en.reviews.*.text' => 'Review Text (English)',
            'ar.reviews.*.image' => 'صورة المراجع (عربي)',
            'en.reviews.*.image' => 'Reviewer Image (English)',
            'file.*' => 'الصورة',
        ];
    }
}
