<?php

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\Todo\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ("API Running...");
});

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth')->name('auth.logout');
});

Route::prefix('todos')->middleware('auth')->group(function () {
    Route::post('/', [TodoController::class, 'store'])->middleware('permission:create todo')->name('todo.store');
    Route::patch('/changeTodoState', [TodoController::class, 'changeTodoState'])->middleware('permission:edit todo')->name('todo.changeTodoState');
    Route::put('/', [TodoController::class, 'update'])->middleware('permission:edit todo')->name('todo.edit');
    Route::get('/', [TodoController::class, 'index'])->middleware('permission:view todo')->name('todo.view');
    Route::delete('/', [TodoController::class, 'delete'])->middleware('permission:delete todo')->name('todo.delete');
});
