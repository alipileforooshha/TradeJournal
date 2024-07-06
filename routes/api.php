<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StrategyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/get-otp',[AuthController::class, 'getOtp']);
Route::post('/verify-otp',[AuthController::class, 'verifyOtp']);
Route::post('/register',[AuthController::class, 'register']);

Route::prefix("strategies")->middleware("auth:api")->group( function(){
    Route::post("",[StrategyController::class, 'create'])->name("strategy.create");
    Route::get("",[StrategyController::class, 'index'])->name("strategy.create");
});