<?php

namespace App\Models;

use App\Enums\TradeTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'    
    ];

    protected $casts = [
        "type" => TradeTypeEnum::class,
        "entry_date" => "datetime"
    ];
}
