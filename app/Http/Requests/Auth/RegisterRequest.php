<?php

namespace App\Http\Requests\Auth;

use App\Exceptions\FailedValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            "mobile" => ["required"],
            "password" => ["required","confirmed", "min:8"],
        ];
    }
    
    public function messages()
    {
        return [
            "mobile.required" => "وارد کردن شماره موبایل الزامی ست",
            "password.required" => "وارد کردن رمز عبور الزامی ست",
            "password.confirmed" => "تایید رمز عبور صحیح نمیباشد",
            "password.min" => "رمز باید حداقل 8 رقم باشد"
        ];    
    }

    protected function failedValidation(Validator $validator)
    {
        throw new FailedValidationException($validator->errors()->toArray());
    }
}
