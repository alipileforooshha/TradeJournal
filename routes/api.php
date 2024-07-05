<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/get-otp',[AuthController::class, 'getOtp']);
Route::post('/verify-otp',[AuthController::class, 'verifyOtp']);
Route::post('/register',[AuthController::class, 'register']);