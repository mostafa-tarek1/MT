<?php

namespace App\Modules\Base\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PhoneNumber implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Saudi phone number validation (05xxxxxxxx or 9665xxxxxxxx)
        if (! preg_match('/^(05|9665)\d{8}$/', $value)) {
            $fail(__('validation.custom.phone.invalid'));
        }
    }
}
