<?php

namespace App\Modules\Base\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class EnglishOnly implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! preg_match('/^[a-zA-Z\s]+$/', $value)) {
            $fail(__('validation.custom.english_only'));
        }
    }
}
