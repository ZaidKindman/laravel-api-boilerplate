<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Request $request) {
    return ("API Running...");
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
