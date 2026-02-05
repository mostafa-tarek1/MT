<?php

namespace App\Modules\Base\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ArabicOnly implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! preg_match('/^[\p{Arabic}\s]+$/u', $value)) {
            $fail(__('validation.custom.arabic_only'));
        }
    }
}
