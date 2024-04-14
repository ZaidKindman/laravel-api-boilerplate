<?php

use App\Enums\System\PermissionsEnum;
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
    Route::post('/', [TodoController::class, 'store'])->middleware('permission:' . PermissionsEnum::CREATE_TODO->value)->name('todo.store');
    Route::patch('/changeTodoState', [TodoController::class, 'changeTodoState'])->middleware('permission:' . PermissionsEnum::CHANGE_TODO_STATE->value)->name('todo.changeTodoState');
    Route::put('/', [TodoController::class, 'update'])->middleware('permission:' . PermissionsEnum::UPDATE_TODO->value)->name('todo.edit');
    Route::get('/', [TodoController::class, 'index'])->middleware('permission:' . PermissionsEnum::READ_TODO->value)->name('todo.view');
    Route::delete('/', [TodoController::class, 'delete'])->middleware('permission:' . PermissionsEnum::DELETE_TODO->value)->name('todo.delete');
});
