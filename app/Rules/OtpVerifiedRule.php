<?php

namespace App\Rules;

use App\Models\Otp;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class OtpVerifiedRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(Otp::where($attribute, $value)->where('verified', true)->first())
        {
            $fail('شماره موبایل شما از قبل تایید شده است');
        }
    }
}
