<?php

namespace App\Enums;

enum TradeTypeEnum : string {
    case BUY = "BUY";
    case SELL = "SELL";
    case BUY_LIMIT = "BUY_LIMIT";
    case SELL_LIMIT = "SELL_LIMIT";
    case BUY_STOP = "BUY_STOP";
    case SELL_STOP = "SELL_STOP";
}