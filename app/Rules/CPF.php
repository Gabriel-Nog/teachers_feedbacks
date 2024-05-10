<?php

namespace App\Rules;

use Closure;
use Illuminate\Broadcasting\UniqueBroadcastEvent;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

class CPF implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if($teste = Rule::unique(User::class, $attribute)) {
            dd($teste);
            $fail("Este CPF já está em nossa base de dados");
        }
    }
}
