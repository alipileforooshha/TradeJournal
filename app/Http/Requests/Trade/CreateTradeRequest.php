<?php

namespace App\Http\Requests\Trade;

use Illuminate\Foundation\Http\FormRequest;

class CreateTradeRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "symbol" => ["required"],
            "description" => [],
            "entry_vol" => [],
            "entry_price" => [],
            "exit_price" => [],
            "sl" => [],
            "tp" => [],
            "profit" => [],
            "entry_date" => [],
            "exit_date" => [],
            "strategy_id" => [],
        ];
    }

    public function messages()
    {
        return [
            "symbol.required" => "وارد کردن نماد مورد نیاز است"
        ];
    }
}
