<?php

namespace App\Rules;

use Closure;
use Felipechiodini\Cpf\Cpf as ObjectCpf;
use Felipechiodini\Cpf\Validator;
use Illuminate\Contracts\Validation\ValidationRule;

class Cpf implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (Validator::isInvalid(new ObjectCpf($value))) {
            $fail(__('validation.cpf'));
        }
    }
}
