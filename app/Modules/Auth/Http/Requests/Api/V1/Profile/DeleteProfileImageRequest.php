<?php

namespace App\Modules\Auth\Http\Requests\Api\V1\Profile;

use Illuminate\Foundation\Http\FormRequest;

class DeleteProfileImageRequest extends FormRequest
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
        return [
            // No validation rules needed for deletion
        ];
    }
}
