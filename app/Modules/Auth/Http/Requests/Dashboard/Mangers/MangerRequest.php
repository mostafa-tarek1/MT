<?php

namespace App\Modules\Auth\Http\Requests\Dashboard\Mangers;

use App\Modules\Auth\Rules\Phone;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MangerRequest extends FormRequest
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
        $isUpdate = $this->isMethod('PUT') || $this->isMethod('PATCH');

        return [
            'id' => ['nullable', Rule::exists('managers', 'id')],
            'role_id' => ['required', Rule::exists('roles', 'id')],
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email:rfc,dns',
                $isUpdate
                    ? Rule::unique('managers', 'email')->ignore($this->id, 'id')
                    : Rule::unique('managers', 'email'),
            ],
            'phone' => [
                'required',
                new Phone,
                $isUpdate
                    ? Rule::unique('managers', 'phone')->ignore($this->id, 'id')
                    : Rule::unique('managers', 'phone'),
            ],
            'password' => $isUpdate ? 'nullable|min:8' : ['required', 'min:8'],
            'password_confirmation' => $isUpdate ? 'nullable|same:password' : ['required', 'same:password'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'is_active' => 'nullable|in:0,1',
        ];
    }
}
