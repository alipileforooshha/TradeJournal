<?php

namespace App\Http\Requests\Auth;

use App\Exceptions\FailedValidationException;
use App\Rules\OtpExpirationTimeRule;
use App\Rules\OtpVerifiedRule;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VerifyOtpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "mobile" => [
                "required", 
                'regex:^(\\+98|0)?9\\d{9}$^',
                Rule::exists('otps','mobile'), 
                new OtpExpirationTimeRule,
                new OtpVerifiedRule,
            ],
            "otp_id" => ["required", Rule::exists('otps','id')],
            "code" => ["required", 'regex:/^\d{4}$/']
        ];
    }

    public function messages(): array
    {
        return [
            "mobile.required" => "وارد کردن شماره موبایل الزامی است",
            "otp_id.required" => "شناسه اعتبار سنجی الزامی ست",
            "mobile.regex" => "فرمت شماره موبایل نا معتبر است",
            "mobile.exists" => "درخواستی برای شما ثبت نشده است",
            "otp_id.exists" => "شناسه اعتبار سنجی نامعتبر است",
            "code.required" => "وارد کردن شماره موبایل الزامی است",
            "code.regex" => "فرمت کد تایید وارد شده نامعتبر است",
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new FailedValidationException($validator->errors()->toArray());
    }
}
