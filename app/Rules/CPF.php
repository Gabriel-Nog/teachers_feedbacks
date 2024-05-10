<?php

namespace App\Rules;

use Closure;
use Illuminate\Broadcasting\UniqueBroadcastEvent;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;

class CPF implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(Rule::unique($value)){
            $fail("Este CPF já está em nossa base de dados");
        }
    }
}
