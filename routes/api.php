<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Todo\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ("API Running...");
});

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth');
});

Route::prefix('todos')->middleware('auth')->group(function () {
    Route::post('/', [TodoController::class, 'store']);
    Route::patch('/changeTodoState', [TodoController::class, 'changeTodoState']);
    Route::put('/', [TodoController::class, 'update']);
    Route::get('/', [TodoController::class, 'index']);
    Route::delete('/', [TodoController::class, 'delete']);
});
