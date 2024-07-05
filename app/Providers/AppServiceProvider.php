<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Response::macro("success", function($message, $data = null, $status){
            return response()->json([
                "message" => $message,
                "data" => $data
            ],$status);
        });

        Response::macro("failed", function($message, $status){
            return response()->json([
                "message" => $message,
            ],$status);
        });

        Response::macro("error", function($message, $data, $status){
            return response()->json([
                "message" => $message,
                "data" => $data,
            ],$status);
        });
    }
}
