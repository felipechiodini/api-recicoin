<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PasswordStrength implements ValidationRule
{

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W]).{8,}$/", $value)) {
            $fail(__('validation.password_strength'));
        }
    }

}
