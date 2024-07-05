<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\GetOtpRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\VerifyOtpRequest;
use App\Models\Otp;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class AuthController extends Controller
{
    public function getOtp(GetOtpRequest $request)
    {
        $data = $request->all();
        $data['expires_at'] = Carbon::now()->addMinutes(2);
        $data['code'] = env("APP_ENV") == "development" ? "8888" : rand(1000,9999);
        $otp = Otp::create($data);

        $data = [
            'otp_id' => $otp->id
        ];

        return Response::success("کد تایید برای شما پیامک شد", $data, HttpResponse::HTTP_OK);
    }

    public function verifyOtp(VerifyOtpRequest $request)
    {
        $otp = Otp::find($request->otp_id);
        if($otp->code == $request->code){
            $otp->verified = true;
            $otp->save();
            return Response::success('کد با موفقیت ثبت شد',null,HttpResponse::HTTP_OK);
        }
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->all();
        $mobiles = Otp::where("verified",true)->pluck('mobile');
        
        if($mobiles->contains($request->mobile))
        {
            $data['password'] = Hash::make($request->password);
            $user = User::create($data);
            $token = $user->createToken("laravel")->accessToken;
        }else{
            return Response::failed('شماره موبایل شما تایید نشده است',422);
        }

        $data = [
            'user' => $user,
            'token' => $token
        ];
        
        return Response::success("ثبت نام شما با موفقیت انجام شد",$data,HttpResponse::HTTP_OK);
    }
}