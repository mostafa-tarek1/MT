<?php

namespace App\Modules\Structure\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ar.form_title' => 'required|string|max:255',
            'ar.form_subtitle' => 'required|string',
            'ar.info_title' => 'required|string|max:255',
            'ar.info_description' => 'required|string',
            'ar.phone_label' => 'required|string|max:255',
            'ar.email_label' => 'required|string|max:255',
            'en.form_title' => 'required|string|max:255',
            'en.form_subtitle' => 'required|string',
            'en.info_title' => 'required|string|max:255',
            'en.info_description' => 'required|string',
            'en.phone_label' => 'required|string|max:255',
            'en.email_label' => 'required|string|max:255',
            'all.phone' => 'required|string|max:255',
            'all.email' => 'required|email|max:255',
        ];
    }

    public function attributes(): array
    {
        return [
            'ar.form_title' => 'عنوان النموذج (عربي)',
            'ar.form_subtitle' => 'العنوان الفرعي للنموذج (عربي)',
            'ar.info_title' => 'عنوان معلومات التواصل (عربي)',
            'ar.info_description' => 'وصف معلومات التواصل (عربي)',
            'ar.phone_label' => 'تسمية الهاتف (عربي)',
            'ar.email_label' => 'تسمية البريد الإلكتروني (عربي)',
            'en.form_title' => 'Form Title (English)',
            'en.form_subtitle' => 'Form Subtitle (English)',
            'en.info_title' => 'Contact Info Title (English)',
            'en.info_description' => 'Contact Info Description (English)',
            'en.phone_label' => 'Phone Label (English)',
            'en.email_label' => 'Email Label (English)',
            'all.phone' => 'رقم الهاتف',
            'all.email' => 'البريد الإلكتروني',
        ];
    }
}

