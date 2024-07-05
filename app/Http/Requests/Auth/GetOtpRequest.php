<?php

namespace App\Http\Requests\Auth;

use App\Exceptions\FailedValidationException;
use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GetOtpRequest extends FormRequest
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
            "mobile" => ["required", Rule::notIn(User::pluck('mobile')), 'regex:^(\\+98|0)?9\\d{9}$^']
        ];
    }

    public function messages()
    {
        return[
            "mobile.required" => "وارد کردن شماره موبایل الزامی ست",
            "mobile.not_in" => "شما از قبل ثبت نام کرده اید",
            "mobile.regex" => "فرمت شماره موبایل نا معتبر است"
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new FailedValidationException($validator->errors()->toArray());
    }

}
