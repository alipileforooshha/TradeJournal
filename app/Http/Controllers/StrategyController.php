<?php

namespace App\Http\Controllers;

use App\Http\Requests\strategy\CreateStrategyRequest;
use App\Http\Resources\Strategy\StrategyCollection;
use App\Models\Strategy;
use GuzzleHttp\Psr7\Response as Psr7Response;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HTTP;
use Illuminate\Support\Facades\Response;

class StrategyController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = auth('api')->user();
    }

    public function index()
    {
        $strategies = $this->user->strategies()->paginate(10);
        // return $strategies;
        $data = new StrategyCollection($strategies);
        // return $data;
        return Response::success('لیست استراتژی ها با موفقیت بازگردانده شد',$data, HTTP::HTTP_OK);
    }

    public function create(CreateStrategyRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = $this->user->id;
        $strategy = Strategy::create($data);

        return Response::success('استراتژی با موفقیت ساخته شد',$strategy, HTTP::HTTP_OK);
    }
}
