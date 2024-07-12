<?php

namespace App\Http\Controllers;

use App\Http\Requests\Trade\CreateTradeRequest;
use App\Models\Close;
use App\Models\Tp;
use App\Models\Trade;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Response;

class TradeController extends Controller
{
    public function create(CreateTradeRequest $request)
    {
        // return $request->tp;
        $data = $request->only(["symbol","timeframe","type","entry_vol","entry_price","entry_date","description","strategy_id"]);
        $trade = Trade::create($data);
        foreach($request->tps as $tp)
        {
            Tp::create([
                "price" => $tp,
                "trade_id" => $trade->id
            ]);
        }
        foreach($request->closes as $close)
        {
            Close::create([
                "price" => $close,
                "trade_id" => $trade->id
            ]);
        }
        return Response::success("معامله با موفقیت ثبت شد",null,HttpResponse::HTTP_OK);
    }
}
