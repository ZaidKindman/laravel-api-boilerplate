<?php

namespace App\Providers;

use

    Illuminate\Support\Facades\Response;
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
        Response::macro('success', function ($data) {
            return response()->json([
                'data' => $data,
                'success' => true,
                'message' => null,
                'errors' => null,
            ]);
        });

        Response::macro('error', function ($error, $error_message, $status_code) {
            return response()->json([
                'success' => false,
                'message' => $error_message,
                'errors' => $error,
            ], $status_code);
        });
    }
}
