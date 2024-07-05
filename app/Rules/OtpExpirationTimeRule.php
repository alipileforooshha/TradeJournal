<?php

namespace App\Rules;

use App\Models\Otp;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class OtpExpirationTimeRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(Otp::where($attribute, $value)->where('expires_at', '<', Carbon::now())->first())
        {
            $fail('زمان درخواست شما گذشته است');
        }
    }
}
