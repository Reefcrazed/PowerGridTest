<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CustomMoney implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $money = preg_replace('/[$,]/', '', $value);

        if (!(is_numeric($money) )) {
            $fail('Input correct currency format.');
        }

        if ($money < 0) {
            $fail('Input correct currency format.');
        }

        if ($money >= 99999999.99) {
            $fail('Input correct currency format.');
        }
    }
}