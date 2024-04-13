<?php

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\Todo\TodoController;
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
    Route::post('/', [TodoController::class, 'store'])->middleware('permission:create todo');
    Route::patch('/changeTodoState', [TodoController::class, 'changeTodoState'])->middleware('permission:edit todo');
    Route::put('/', [TodoController::class, 'update'])->middleware('permission:edit todo');
    Route::get('/', [TodoController::class, 'index'])->middleware('permission:view todo');
    Route::delete('/', [TodoController::class, 'delete'])->middleware('permission:delete todo');
});
